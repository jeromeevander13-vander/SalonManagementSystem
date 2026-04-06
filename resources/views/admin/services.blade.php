<div x-data="servicesManager()">
<div class="mb-10 w-full flex flex-col md:flex-row justify-between items-start md:items-end border-b border-white/10 pb-6 gap-4">
    <div class="flex-grow">
        <h1 class="text-4xl md:text-5xl font-black uppercase italic bg-clip-text text-transparent bg-gradient-to-r from-red-500 via-white to-gray-500 drop-shadow-sm tracking-tight">Service Menu</h1>
        <p class="text-gray-400 text-sm font-bold tracking-[0.2em] uppercase mt-2">Manage Salon Offerings <span class="bg-red-500/20 text-red-400 px-2 py-0.5 rounded ml-2">{{ count($services) }} Total</span></p>
    </div>
    <button @click="addModal = true" class="w-full md:w-auto bg-gradient-to-r from-red-700 to-red-900 hover:from-red-600 hover:to-red-800 text-white font-black uppercase italic text-xs py-3.5 px-8 rounded transition-all duration-300 shadow-[0_0_15px_rgba(239,68,68,0.2)] hover:shadow-[0_0_25px_rgba(239,68,68,0.4)] hover:-translate-y-1 flex justify-center items-center border border-red-500/30">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Add New Service
    </button>
</div>

@if(count($services) == 0)
<div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded p-12 text-center shadow-2xl">
    <div class="flex flex-col items-center justify-center opacity-40">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-red-500 mb-4 drop-shadow-[0_0_8px_rgba(239,68,68,0.5)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.121 14.121L19 19m-7-7l7 7m-7-7l-2.828 2.828M11 11L7 7m4 4L7 15m4-4l4-4M4 4h16v16H4V4z" />
        </svg>
        <p class="text-gray-400 font-black uppercase italic tracking-[0.4em] text-sm">Registry Empty</p>
        <p class="text-gray-600 text-xs font-bold uppercase mt-2 italic tracking-widest">No services found in database</p>
    </div>
</div>
@else
<div class="flex flex-wrap justify-center sm:justify-start gap-6">
    @foreach ($services as $service)
    <div class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)] xl:w-[calc(25%-1.5rem)] max-w-sm bg-black/40 backdrop-blur-sm border border-white/10 rounded shadow-2xl overflow-hidden flex flex-col hover:border-red-500/50 hover:shadow-[0_0_20px_rgba(239,68,68,0.15)] hover:-translate-y-1 transition-all duration-300 relative group flex-grow">
        <!-- Service Image -->
        <div class="h-48 w-full bg-black relative overflow-hidden border-b border-white/5 shadow-inner">
            @if($service->image)
                <img src="{{ strpos($service->image, 'services/') === 0 ? \Illuminate\Support\Facades\Storage::disk('s3')->url($service->image) : asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 group-hover:scale-105 transition duration-700">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 to-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-900 opacity-50 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[9px] text-red-500/50 font-bold uppercase tracking-widest">No Image Uploaded</span>
                </div>
            @endif
            <!-- Status Badge -->
            <div class="absolute top-3 right-3 z-10">
                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-full shadow-lg backdrop-blur-md {{ $service->status === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/30' : 'bg-red-500/10 text-red-400 border border-red-500/30' }}">
                    {{ $service->status }}
                </span>
            </div>
            <!-- Overlay Gradient for Text Contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
        </div>
        
        <!-- Service Details -->
        <div class="p-5 flex-grow flex flex-col relative z-20">
            <div class="flex items-start justify-between mb-2">
                <h3 class="text-xl font-black text-white uppercase italic tracking-tight group-hover:text-red-400 transition-colors duration-300">{{ $service->name }}</h3>
                @if($service->category)
                <span class="px-2 py-0.5 mt-1 text-[8px] font-black uppercase tracking-widest rounded bg-white/5 text-gray-300 border border-white/10 whitespace-nowrap ml-2 shadow-sm">
                    {{ $service->category }}
                </span>
                @endif
            </div>
            
            <p class="text-xs text-gray-400/80 mb-4 line-clamp-3 leading-relaxed flex-grow font-medium">
                {{ $service->description ?: 'No description provided for this service.' }}
            </p>
            
            <div class="flex items-end justify-between mt-auto mb-4 border-t border-white/5 pt-4">
                <div>
                    <p class="text-[9px] font-bold text-red-500 uppercase tracking-widest mb-1 opacity-80">Price</p>
                    <p class="text-xl font-black text-white drop-shadow-md">₱{{ number_format((float) $service->price, 2) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-bold text-red-500 uppercase tracking-widest mb-1 opacity-80">Duration</p>
                    <p class="text-sm font-bold text-gray-300 italic">{{ $service->duration ? $service->duration . ' min' : 'N/A' }}</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="grid grid-cols-2 gap-2 mt-2">
                <button @click="openEditModal({{ $service->id }}, {{ json_encode($service->name) }}, {{ json_encode($service->description) }}, {{ $service->price }}, {{ json_encode($service->duration) }}, '{{ $service->status }}', {{ json_encode($service->category) }})" class="bg-white/5 hover:bg-white/10 text-blue-400 text-[10px] font-black uppercase italic py-2.5 rounded transition duration-300 flex items-center justify-center border border-white/10 hover:border-blue-500/30 hover:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit
                </button>
                <button @click="openDeleteModal({{ $service->id }}, {{ json_encode($service->name) }})" class="bg-red-500/10 hover:bg-red-500/20 text-red-400 text-[10px] font-black uppercase italic py-2.5 rounded transition duration-300 flex items-center justify-center border border-red-500/20 hover:border-red-500/50 hover:text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    Delete
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Add Modal -->
<div x-show="addModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="bg-gray-950/90 backdrop-blur-xl w-full max-w-md rounded-lg border border-white/10 shadow-2xl relative overflow-hidden transform transition-all" @click.stop x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
        <div class="bg-gradient-to-r from-red-900/30 to-black/30 border-b border-white/10 px-6 py-4 flex justify-between items-center relative z-10">
            <h3 class="font-black text-white uppercase italic text-[12px] tracking-[0.2em] bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-white">Add New Service</h3>
            <button @click="addModal = false" class="text-gray-400 hover:text-red-400 transition-colors text-xl bg-white/5 hover:bg-white/10 w-8 h-8 rounded-full flex items-center justify-center border border-white/5 hover:border-white/10">&times;</button>
        </div>
        
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 relative z-10">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Service Name</label>
                <input type="text" name="name" placeholder="e.g. Classic Fade" 
                    class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 placeholder-gray-600 shadow-inner" required>
            </div>

            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Category</label>
                <input type="text" name="category" placeholder="e.g. Haircut, Spa" 
                    class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 placeholder-gray-600 shadow-inner">
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Description</label>
                <textarea name="description" rows="3" placeholder="Service details..." 
                    class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 placeholder-gray-600 shadow-inner"></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Service Image</label>
                <div class="relative w-full border-2 border-dashed border-white/10 hover:border-red-500/50 transition-colors duration-300 bg-black/30 rounded-lg p-5 text-center cursor-pointer group">
                    <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-gray-500 group-hover:text-red-400 transition-colors mb-2 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    <p class="text-[9px] text-gray-400 group-hover:text-red-300 transition-colors font-bold uppercase tracking-widest">Click to upload image</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Price (₱)</label>
                    <input type="number" name="price" step="0.01" placeholder="0.00" 
                        class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 placeholder-gray-600 shadow-inner" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Duration (Min)</label>
                    <input type="number" name="duration" placeholder="30" 
                        class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 placeholder-gray-600 shadow-inner">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Status</label>
                <div class="relative">
                    <select name="status" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 appearance-none cursor-pointer shadow-inner">
                        <option value="active" class="bg-gray-900 text-white">Active</option>
                        <option value="inactive" class="bg-gray-900 text-white">Inactive</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-[2] bg-gradient-to-r from-red-700 to-red-900 hover:from-red-600 hover:to-red-800 text-white font-black uppercase italic text-xs py-3.5 rounded transition-all duration-300 shadow-lg hover:shadow-red-500/30 border border-red-500/20 text-center">
                    Add Service
                </button>
                <button type="button" @click="addModal = false" class="flex-1 bg-white/5 hover:bg-white/10 text-gray-300 font-bold uppercase italic text-xs py-3.5 rounded border border-white/10 transition-colors duration-300 text-center">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div x-show="editModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="bg-gray-950/90 backdrop-blur-xl w-full max-w-md rounded-lg border border-white/10 shadow-2xl relative overflow-hidden transform transition-all" @click.stop x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
        <div class="bg-gradient-to-r from-red-900/30 to-black/30 border-b border-white/10 px-6 py-4 flex justify-between items-center relative z-10">
            <h3 class="font-black text-white uppercase italic text-[12px] tracking-[0.2em] bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-white">Edit Service</h3>
            <button @click="editModal = false" class="text-gray-400 hover:text-red-400 transition-colors text-xl bg-white/5 hover:bg-white/10 w-8 h-8 rounded-full flex items-center justify-center border border-white/5 hover:border-white/10">&times;</button>
        </div>
        <form @submit.prevent="updateService" class="p-6 space-y-4 relative z-10">
            <input type="hidden" x-model="editForm.id">
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Service Name</label>
                <input type="text" x-model="editForm.name" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 shadow-inner" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Category</label>
                <input type="text" x-model="editForm.category" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 shadow-inner">
            </div>
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Description</label>
                <textarea x-model="editForm.description" rows="3" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 shadow-inner"></textarea>
            </div>
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Update Image</label>
                <div class="relative w-full border-2 border-dashed border-white/10 hover:border-red-500/50 transition-colors duration-300 bg-black/30 rounded-lg p-4 text-center cursor-pointer group">
                    <input type="file" @change="editForm.image = $event.target.files[0]" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    <p class="text-[9px] text-gray-400 group-hover:text-red-300 transition-colors font-bold uppercase tracking-widest">Select new image<br><span class="opacity-50 lowercase text-[8px]">(optional)</span></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Price (₱)</label>
                    <input type="number" x-model="editForm.price" step="0.01" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 shadow-inner" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Duration (Min)</label>
                    <input type="number" x-model="editForm.duration" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 shadow-inner">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-red-500 uppercase mb-1 tracking-widest opacity-80">Status</label>
                <div class="relative">
                    <select x-model="editForm.status" class="w-full bg-black/50 border border-white/10 text-white text-xs p-3 rounded focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors duration-300 appearance-none cursor-pointer shadow-inner">
                        <option value="active" class="bg-gray-900 text-white">Active</option>
                        <option value="inactive" class="bg-gray-900 text-white">Inactive</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-[2] bg-gradient-to-r from-red-700 to-red-900 hover:from-red-600 hover:to-red-800 text-white font-black uppercase italic text-xs py-3.5 rounded transition-all duration-300 shadow-lg hover:shadow-red-500/30 border border-red-500/20 text-center">Save Changes</button>
                <button @click="editModal = false" type="button" class="flex-1 bg-white/5 hover:bg-white/10 text-gray-300 font-bold uppercase italic text-xs py-3.5 rounded border border-white/10 transition-colors duration-300 text-center">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div x-show="deleteModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="bg-gray-950/90 backdrop-blur-xl w-full max-w-sm rounded-lg border border-white/10 shadow-2xl relative overflow-hidden transform transition-all" @click.stop x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
        <div class="bg-gradient-to-r from-red-900/40 to-black/30 border-b border-red-900/30 px-6 py-4">
            <h3 class="font-black text-white uppercase italic text-[12px] tracking-[0.2em] bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-white">Confirm Action</h3>
        </div>
        <div class="p-8 text-center relative z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-red-500 mb-4 drop-shadow-[0_0_8px_rgba(239,68,68,0.5)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-white font-bold text-sm mb-6">Are you sure you want to permanently delete the service "<span x-text="deleteServiceName" class="text-red-400 drop-shadow-sm uppercase italic font-black"></span>"?</p>
            <div class="flex flex-col gap-3">
                <button @click="deleteService" class="w-full bg-gradient-to-r from-red-700 to-red-900 hover:from-red-600 hover:to-red-800 text-white font-black uppercase italic text-xs py-3.5 rounded transition-all duration-300 shadow-lg hover:shadow-red-500/30 border border-red-500/20">Proceed with deletion</button>
                <button @click="deleteModal = false" type="button" class="w-full bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 font-bold uppercase italic text-xs py-3.5 rounded transition-colors duration-300">Keep Service</button>
            </div>
        </div>
    </div>
</div>

</div> <!-- This closes the global x-data wrapper for servicesManager -->

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('servicesManager', () => ({
        addModal: false,
        editModal: false,
        deleteModal: false,
        editForm: {
            id: '',
            name: '',
            description: '',
            price: '',
            duration: '',
            status: 'active',
            category: '',
            image: null
        },
        deleteServiceId: '',
        deleteServiceName: '',

        openEditModal(id, name, description, price, duration, status, category) {
            this.editForm = { id, name, description, price, duration, status, category, image: null };
            document.querySelectorAll('input[type="file"]').forEach(input => input.value = '');
            this.editModal = true;
        },

        openDeleteModal(id, name) {
            this.deleteServiceId = id;
            this.deleteServiceName = name;
            this.deleteModal = true;
        },

        async updateService() {
            const formData = new FormData();
            formData.append('id', this.editForm.id);
            formData.append('name', this.editForm.name);
            formData.append('description', this.editForm.description || '');
            formData.append('price', this.editForm.price);
            formData.append('duration', this.editForm.duration || '');
            formData.append('status', this.editForm.status);
            formData.append('category', this.editForm.category || '');
            if (this.editForm.image) {
                formData.append('image', this.editForm.image);
            }
            formData.append('_method', 'PUT');

            const response = await fetch(`/admin/services/${this.editForm.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            if (response.ok) {
                alert('Service updated successfully!');
                location.reload();
            } else {
                alert('Error updating service');
            }
        },

        async deleteService() {
            const response = await fetch(`/admin/services/${this.deleteServiceId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                alert('Service deleted successfully!');
                location.reload();
            } else {
                alert('Error deleting service');
            }
        }
    }));
});
</script>