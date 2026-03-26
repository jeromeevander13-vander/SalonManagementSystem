<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        \App\Models\Testimonial::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_visible' => true, // default to visible for now
        ]);

        return back()->with('success', 'Thank you for your feedback! Your testimony has been posted.');
    }
}
