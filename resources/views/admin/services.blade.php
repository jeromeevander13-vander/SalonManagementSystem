<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Service Menu</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Manage Salon Offerings</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1">
        <div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
            <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3">
                <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">Add New Service</h3>
            </div>
            
            <form action="#" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Service Name</label>
                    <input type="text" name="name" placeholder="e.g. Classic Fade" 
                        class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition placeholder-gray-800">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Description</label>
                    <textarea name="description" rows="3" placeholder="Service details..." 
                        class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition placeholder-gray-800"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Price (₱)</label>
                        <input type="number" name="price" placeholder="0.00" 
                            class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-red-500 uppercase mb-1">Duration (Min)</label>
                        <input type="number" name="duration" placeholder="30" 
                            class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:outline-none focus:ring-1 focus:ring-red-500 transition">
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-red-700 hover:bg-red-600 text-white font-black uppercase italic text-xs py-3 rounded transition shadow-lg mt-4">
                    Add Service
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
            <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3 flex justify-between items-center">
                <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">Active Services</h3>
                <span class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Total Items: 0</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-red-900 text-red-500 font-black uppercase italic">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Duration</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="px-6 py-24 text-center">
                                <div class="flex flex-col items-center justify-center opacity-20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-900 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.121 14.121L19 19m-7-7l7 7m-7-7l-2.828 2.828M11 11L7 7m4 4L7 15m4-4l4-4M4 4h16v16H4V4z" />
                                    </svg>
                                    <p class="text-gray-500 font-black uppercase italic tracking-[0.4em] text-[10px]">Registry Empty</p>
                                    <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">No services found in database</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>