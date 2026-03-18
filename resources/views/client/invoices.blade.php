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
                <tbody class="divide-y divide-red-900/20">
                    @forelse($invoices as $invoice)
                    <tr class="hover:bg-red-900/5 transition-colors">
                        <td class="px-6 py-4 text-white font-black italic text-[10px]">#INV-{{ $invoice->id }}</td>
                        <td class="px-6 py-4">
                            <p class="text-white font-bold uppercase text-[10px] italic">{{ $invoice->service ? $invoice->service->name : ($invoice->service_type ?? 'N/A') }}</p>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Salon Service</p>
                        </td>
                        <td class="px-6 py-4 text-[10px] text-gray-300 font-bold uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($invoice->appointment_time)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-white font-black italic text-[10px]">
                            {{ $invoice->service ? '₱' . number_format((float) preg_replace('/[^0-9.]/', '', $invoice->service->price), 2) : '---' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-green-900/40 text-green-500 border border-green-900/50">
                                PAID
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="bg-red-900/20 text-red-500 text-[9px] font-black px-3 py-1 rounded uppercase tracking-tighter hover:bg-red-600 hover:text-white transition">View PDF</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-32 text-center bg-black">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-gray-700 italic text-lg font-light tracking-widest">You have no invoices yet.</span>
                                <div class="mt-3 h-[1px] w-12 bg-red-900/50"></div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>