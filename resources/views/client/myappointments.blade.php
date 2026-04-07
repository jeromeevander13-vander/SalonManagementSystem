<div>
    <div class="mb-8">
        <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">My Appointments</h2>
        <p class="text-red-500 text-xs font-bold uppercase tracking-[0.2em] mt-1">Manage your upcoming and past salon magic sessions</p>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($appointments as $appointment)
        <div class="bg-card-dark border border-red-900/50 rounded p-6 flex flex-col md:flex-row items-center justify-between group hover:border-red-600 transition-all shadow-xl relative overflow-hidden">
            <!-- Background Accent -->
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-red-600 to-transparent opacity-50"></div>

            <div class="flex items-center space-x-6 w-full md:w-auto">
                <!-- Service Icon/Image Placeholder -->
                <div class="hidden sm:flex w-16 h-16 rounded bg-black border border-red-900 items-center justify-center text-red-600 relative overflow-hidden">
                    @if($appointment->service && $appointment->service->image)
                        <img src="{{ str_starts_with($appointment->service->image, 'services/') ? \Illuminate\Support\Facades\Storage::disk('s3')->url($appointment->service->image) : asset($appointment->service->image) }}" class="w-full h-full object-cover opacity-60">
                    @else
                        <svg class="w-8 h-8 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758L5 19m0-14l4.121 4.121" /></svg>
                    @endif
                </div>

                <div class="flex-1">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.25em] mb-1">Appointment #{{ $appointment->id }}</p>
                    <h3 class="text-xl font-black text-white uppercase italic tracking-tighter group-hover:text-red-500 transition-colors">
                        {{ $appointment->service ? $appointment->service->name : ($appointment->service_type ?? 'Other Service') }}
                    </h3>
                    
                    <div class="flex flex-wrap items-center mt-3 gap-y-2">
                        <div class="flex items-center text-gray-400 mr-6">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center text-gray-400">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:items-end mt-6 md:mt-0 w-full md:w-auto border-t md:border-t-0 border-red-900/30 pt-4 md:pt-0">
                <div class="flex items-center md:flex-col md:items-end gap-3 mb-4">
                    <span class="status-badge status-{{ strtolower($appointment->status) }} shadow-lg">
                        {{ $appointment->status }}
                    </span>
                    <p class="text-xl font-black text-white italic tracking-tighter">
                        {{ $appointment->service ? '₱' . number_format((float) preg_replace('/[^0-9.]/', '', $appointment->service->price), 0) : '---' }}
                    </p>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button @click="selectedAppointment = {{ json_encode($appointment->load('service')) }}; showDetailsModal = true" 
                            class="bg-[#0a0a0a] border border-red-900 text-gray-400 text-[10px] font-black px-4 py-2 uppercase tracking-widest hover:bg-red-900 hover:text-white transition shadow-lg">
                        View Details
                    </button>
                    @if(in_array(strtolower($appointment->status), ['pending', 'accepted']))
                    <form action="{{ route('client.appointment.cancel', $appointment) }}" method="POST" onsubmit="return confirm('Magic sessions are precious. Are you sure you want to cancel?')">
                        @csrf
                        <button type="submit" class="bg-red-900/10 border border-red-900/50 text-red-500 text-[10px] font-black px-4 py-2 uppercase tracking-widest hover:bg-red-600 hover:text-white transition">Cancel</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="py-32 text-center bg-card-dark rounded border border-red-900 border-dashed">
            <div class="flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-red-950/20 rounded-full flex items-center justify-center text-red-600/30 mb-4 text-3xl">🗓</div>
                <h3 class="text-white font-black uppercase italic tracking-tighter text-xl">No Appointments Scheduled</h3>
                <p class="text-gray-500 text-xs uppercase tracking-widest mt-2 max-w-xs mx-auto">It's time to treat yourself to something special!</p>
            </div>
        </div>
        @endforelse
    </div>
</div>