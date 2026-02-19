<!DOCTYPE html>
<html lang="en" class="bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; }
        textarea::-webkit-scrollbar { width: 4px; }
        textarea::-webkit-scrollbar-thumb { background: #7f1d1d; border-radius: 10px; }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-red-950/20 via-black to-black">

    <div class="w-full max-w-md bg-[#0a0a0a] border border-red-900/30 p-8 rounded-2xl shadow-2xl" 
         x-data="{ 
            bookingData: { 
                // Splitting the single DB column into two separate strings for the inputs
                date: '{{ date('Y-m-d', strtotime($appointment->appointment_time)) }}', 
                time: '{{ date('H:i:s', strtotime($appointment->appointment_time)) }}', 
                phone: '{{ $appointment->phone }}', 
                message: `{{ $appointment->message }}`,
                status: '{{ $appointment->status }}'
            } 
         }">
        
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h2 class="text-white text-2xl font-black uppercase tracking-tighter">Edit Session</h2>
                <p class="text-gray-500 text-[10px] mt-1 uppercase tracking-widest">Appointment ID: #{{ $appointment->id }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter transition-all duration-500 border"
                :class="{
                    'bg-yellow-500/10 text-yellow-500 border-yellow-500/50': bookingData.status === 'pending',
                    'bg-green-500/10 text-green-500 border-green-500/50': bookingData.status === 'confirmed',
                    'bg-red-500/10 text-red-500 border-red-500/50': bookingData.status === 'cancelled',
                    'bg-blue-500/10 text-blue-500 border-blue-500/50': bookingData.status === 'completed'
                }"
                x-text="bookingData.status">
            </span>
        </div>

        <form class="space-y-5" method="POST" action="{{ route('appointment.update', $appointment->id) }}">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-[0.2em]">Update Status</label>
                <select name="status" x-model="bookingData.status"
                    class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 focus:ring-1 focus:ring-red-600/20 outline-none transition-all cursor-pointer">
                    <option value="pending">Pending Review</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold uppercase text-red-600 tracking-[0.2em]">Date</label>
                    <input type="date" name="appointment_date" x-model="bookingData.date" required
                        class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 focus:ring-1 focus:ring-red-600/20 outline-none transition-all">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-bold uppercase text-red-600 tracking-[0.2em]">Time Slot</label>
                    <select name="appointment_time" x-model="bookingData.time" required
                        class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 focus:ring-1 focus:ring-red-600/20 outline-none transition-all">
                        <option value="09:00:00">09:00 AM</option>
                        <option value="10:30:00">10:30 AM</option>
                        <option value="13:00:00">01:00 PM</option>
                        <option value="15:30:00">03:30 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-[0.2em]">Contact Number</label>
                <input type="tel" name="phone" x-model="bookingData.phone" required
                    class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 outline-none transition-all">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-[0.2em]">Notes / Special Requests</label>
                <textarea name="message" x-model="bookingData.message" rows="3" 
                    class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 outline-none transition-all resize-none"
                    placeholder="No special requests..."></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" 
                    class="group relative w-full bg-red-700 text-white py-4 rounded-lg font-bold uppercase tracking-[0.2em] shadow-lg hover:bg-red-600 active:scale-[0.98] transition-all duration-200">
                    <span class="relative z-10">Confirm Changes</span>
                    <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
                
                <a href="{{ route('admin_main') }}" class="block text-center mt-4 text-[10px] text-gray-600 uppercase font-bold hover:text-gray-400 transition-colors">
                    Discard and Go Back
                </a>
            </div>
        </form>
    </div>

</body>
</html>