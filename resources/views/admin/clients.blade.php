<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Client Registry</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Customer Database</p>
</div>

<div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
    <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3 flex justify-between items-center">
        <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">All Clients</h3>
        <span class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Total Registered: 0</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-red-900 text-red-500 font-black uppercase italic bg-black bg-opacity-20">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Phone</th>
                    <th class="px-6 py-4">Registered On</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                {{-- Empty State Placeholder --}}
                <tr>
                    <td colspan="5" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center justify-center opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-900 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="text-gray-500 font-black uppercase italic tracking-[0.4em] text-[10px]">Registry Empty</p>
                            <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">Client records will appear here</p>
                        </div>
                    </td>
                </tr>

                {{-- Example of a Row (Commented out for now)
                <tr class="hover:bg-red-900/10 transition">
                    <td class="px-6 py-4 text-white font-bold italic uppercase">Donna Hubber</td>
                    <td class="px-6 py-4 text-gray-400 font-medium">donna@mailinator.com</td>
                    <td class="px-6 py-4 text-gray-400 font-medium">741258960</td>
                    <td class="px-6 py-4 text-gray-500 italic">Aug 16, 2025</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-red-600 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </td>
                </tr>
                --}}
            </tbody>
        </table>
    </div>
</div>