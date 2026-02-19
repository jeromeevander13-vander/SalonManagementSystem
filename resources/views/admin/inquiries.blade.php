<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Manage Inquiries</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Customer Messages & Support</p>
</div>

<div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
    <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3 flex justify-between items-center">
        <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">Inquiry Log</h3>
        <span class="text-red-500 text-[9px] font-bold uppercase tracking-widest">New Messages: 0</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-red-900 text-red-500 font-black uppercase italic bg-black bg-opacity-20">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                {{-- ZERO STATE UI --}}
                <tr>
                    <td colspan="7" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center justify-center opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-900 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500 font-black uppercase italic tracking-[0.4em] text-[10px]">Inbox Empty</p>
                            <p class="text-gray-700 text-[8px] font-bold uppercase mt-2 italic tracking-widest">No customer inquiries found</p>
                        </div>
                    </td>
                </tr>

                {{-- Example Row Structure for later --}}
                {{-- 
                <tr class="hover:bg-red-900/10 transition">
                    <td class="px-6 py-4 text-red-500 font-black">7</td>
                    <td class="px-6 py-4 text-white font-bold italic uppercase">Donna Hubber</td>
                    <td class="px-6 py-4 text-gray-400">donna@mailinator.com</td>
                    <td class="px-6 py-4 text-gray-400 italic">Service Inquiry</td>
                    <td class="px-6 py-4 text-gray-500">2026-02-19</td>
                    <td class="px-6 py-4">
                        <span class="bg-red-900 text-white text-[8px] px-2 py-0.5 rounded font-black uppercase">New</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button class="bg-indigo-600 text-white px-3 py-1 rounded text-[10px] font-black uppercase italic hover:bg-indigo-500">View</button>
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-[10px] font-black uppercase italic hover:bg-red-500">Delete</button>
                    </td>
                </tr>
                --}}
            </tbody>
        </table>
    </div>
</div>