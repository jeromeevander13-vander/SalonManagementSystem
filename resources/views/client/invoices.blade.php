<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-white uppercase tracking-widest">My Invoices</h2>

    <div class="bg-black rounded border border-red-900 overflow-hidden shadow-2xl">
        
        <div class="p-4 border-b border-red-900 bg-[#0a0a0a]">
            <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Invoice History</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse bg-black">
                <thead>
                    <tr class="bg-black text-red-600 uppercase text-[11px] font-black border-b border-red-900">
                        <th class="p-4 tracking-widest">Invoice #</th>
                        <th class="p-4 tracking-widest">Service</th>
                        <th class="p-4 tracking-widest">Date</th>
                        <th class="p-4 tracking-widest">Amount</th>
                        <th class="p-4 tracking-widest">Status</th>
                        <th class="p-4 tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr>
                        <td colspan="6" class="py-32 text-center bg-black">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-gray-700 italic text-lg font-light tracking-widest">You have no invoices.</span>
                                <div class="mt-3 h-[1px] w-12 bg-red-900/50"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>