<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Analytics & Reports</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Business Performance Tracking</p>
</div>

<div class="bg-card-dark border border-red-900 rounded p-6 mb-8 shadow-2xl">
    <form action="#" method="GET" class="flex flex-wrap items-end gap-6">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">Start Date</label>
            <input type="date" name="start_date" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">End Date</label>
            <input type="date" name="end_date" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase">
        </div>
        <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-black uppercase italic text-xs px-8 py-2.5 rounded transition shadow-lg">
            Filter Results
        </button>
    </form>
</div>

<div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden" x-data="{ reportTab: 'sales' }">
    <div class="flex border-b border-red-900 bg-black bg-opacity-40">
        <button @click="reportTab = 'sales'" :class="reportTab === 'sales' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Sales Report</button>
        <button @click="reportTab = 'clients'" :class="reportTab === 'clients' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Client Report</button>
        <button @click="reportTab = 'appointments'" :class="reportTab === 'appointments' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Appointments Report</button>
    </div>

    <div class="p-8">
        <div x-show="reportTab === 'sales'">
            <h2 class="text-white font-black uppercase italic text-lg mb-6">Revenue Overview</h2>
            
            <div class="h-64 flex items-center justify-center border-b border-l border-red-900 p-4 relative bg-black bg-opacity-20">
                
                <div class="text-center opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-900 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-white font-black uppercase italic tracking-[0.5em] text-[10px]">No Data for Selected Range</p>
                    <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">Charts will generate once transactions are recorded</p>
                </div>

            </div>

            <div class="flex justify-around mt-4 text-[8px] font-black text-gray-700 uppercase italic">
                <span>Jan 2026</span>
                <span>Feb 2026</span>
                <span>Mar 2026</span>
                <span>Apr 2026</span>
            </div>
        </div>

        <div x-show="reportTab === 'clients'" x-cloak class="py-20 text-center">
             <div class="opacity-20">
                <p class="text-gray-500 font-black uppercase italic tracking-[0.4em] text-[10px]">No Client Acquisition Data</p>
                <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">Customer growth metrics will appear here</p>
             </div>
        </div>

        <div x-show="reportTab === 'appointments'" x-cloak class="py-20 text-center">
             <div class="opacity-20">
                <p class="text-gray-500 font-black uppercase italic tracking-[0.4em] text-[10px]">No Appointment Analytics</p>
                <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">Booking volume and cancellation rates</p>
             </div>
        </div>
    </div>
</div>