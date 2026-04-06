<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
            'category' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 's3');
        }

        Service::create($data);

        return redirect()->route('admin_main')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
            'category' => 'nullable|string|max:255',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($service->image) {
                if (Storage::disk('s3')->exists($service->image)) {
                    Storage::disk('s3')->delete($service->image);
                } elseif (file_exists(public_path($service->image))) {
                    @unlink(public_path($service->image));
                }
            }
            $data['image'] = $request->file('image')->store('services', 's3');
        }

        $service->update($data);

        return redirect()->route('admin_main')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            if (Storage::disk('s3')->exists($service->image)) {
                Storage::disk('s3')->delete($service->image);
            } elseif (file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }
        }

        $service->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin_main')->with('success', 'Service deleted successfully.');
    }
}
