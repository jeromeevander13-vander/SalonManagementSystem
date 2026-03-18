<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Edit Service</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Update Service Details</p>
</div>

<div class="max-w-2xl">
    <div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
        <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3">
            <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">Edit Service</h3>
        </div>
        
        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Service Name</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}" 
                    class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition" required>
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Description</label>
                <textarea name="description" rows="3" 
                    class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition">{{ old('description', $service->description) }}</textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Price (₱)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $service->price) }}" 
                        class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Duration (Min)</label>
                    <input type="number" name="duration" value="{{ old('duration', $service->duration) }}" 
                        class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition">
                </div>
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Status</label>
                <select name="status" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition">
                    <option value="active" {{ old('status', $service->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $service->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="flex space-x-4">
                <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-black uppercase italic text-xs py-3 px-6 rounded transition shadow-lg">
                    Update Service
                </button>
                <a href="{{ route('admin.services') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-black uppercase italic text-xs py-3 px-6 rounded transition shadow-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>