<div class="mb-8">
    <h1 class="text-3xl font-black text-white uppercase italic">Analytics & Reports</h1>
    <p class="text-red-500 text-sm font-bold tracking-widest uppercase">Business Performance Tracking</p>
</div>

<div class="bg-card-dark border border-red-900 rounded p-6 mb-8 shadow-2xl">
    <form action="{{ route('admin_main') }}" method="GET" class="flex flex-wrap items-end gap-6">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-black uppercase italic text-xs px-8 py-2.5 rounded transition shadow-lg">
                Filter Results
            </button>
            <a href="{{ route('admin_main') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-400 font-black uppercase italic text-xs px-8 py-2.5 rounded transition">
                Clear
            </a>
        </div>
    </form>
</div>

<div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden" x-data="{ reportTab: 'sales' }">
    <div class="flex border-b border-red-900 bg-black bg-opacity-40">
        <button @click="reportTab = 'sales'" :class="reportTab === 'sales' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Sales Report</button>
        <button @click="reportTab = 'clients'" :class="reportTab === 'clients' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Client Report</button>
        <button @click="reportTab = 'appointments'" :class="reportTab === 'appointments' ? 'border-b-2 border-red-600 text-red-500 bg-red-900 bg-opacity-10' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-4 text-[10px] font-black uppercase tracking-widest transition outline-none">Appointments Report</button>
    </div>

    <div class="p-8">
        <!-- Sales Report Tab -->
        <div x-show="reportTab === 'sales'">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-black bg-opacity-30 border border-red-900 p-6 rounded relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 opacity-10 text-4xl italic font-black">$$$</div>
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1">Gross Revenue</p>
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">${{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="bg-black bg-opacity-30 border border-red-900 p-6 rounded relative overflow-hidden">
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1">Growth Forecast</p>
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">+12.5%</h3>
                </div>
                <div class="bg-black bg-opacity-30 border border-red-900 p-6 rounded relative overflow-hidden">
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1">Avg per Visit</p>
                    @php 
                        $avg = $totalAppointments > 0 ? $totalSales / $totalAppointments : 0;
                    @endphp
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">${{ number_format($avg, 2) }}</h3>
                </div>
            </div>

            <h2 class="text-white font-black uppercase italic text-lg mb-6">Revenue Overview</h2>
            
            <div class="lg:col-span-2 bg-black bg-opacity-20 rounded border border-red-900 p-10 shadow-inner relative mb-8">
                @php
                    $maxSales = max(max($chartData), 1);
                    $y1 = 256 - (($chartData[0] / $maxSales) * 236) - 10;
                    $y2 = 256 - (($chartData[1] / $maxSales) * 236) - 10;
                    $y3 = 256 - (($chartData[2] / $maxSales) * 236) - 10;
                    $y4 = 256 - (($chartData[3] / $maxSales) * 236) - 10;
                @endphp
                <div class="relative h-64 w-full border-l border-b border-red-950 chart-container group">
                    <svg viewBox="0 0 1000 256" preserveAspectRatio="none" class="absolute inset-0 w-full h-full">
                        <polyline fill="none" class="transition-all duration-1000" stroke="#ef4444" stroke-width="4" points="0,{{ $y1 }} 333,{{ $y2 }} 666,{{ $y3 }} 1000,{{ $y4 }}" />
                    </svg>
                    <div class="absolute top-0 left-0 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-black" style="top: {{ $y1 }}px;"></div>
                    <div class="absolute top-0 left-1/3 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-black" style="top: {{ $y2 }}px;"></div>
                    <div class="absolute top-0 left-2/3 w-3 h-3 bg-red-600 rounded-full -translate-x-1.5 -translate-y-1.5 border-2 border-black" style="top: {{ $y3 }}px;"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 bg-red-600 rounded-full translate-x-1.5 -translate-y-1.5 border-2 border-black shadow-[0_0_10px_#ff0000]" style="top: {{ $y4 }}px;"></div>
                </div>
                <div class="flex justify-between mt-6 text-[9px] text-gray-500 font-black uppercase italic tracking-widest px-2">
                    <span>{{ $chartLabels[0] }}</span><span>{{ $chartLabels[1] }}</span><span>{{ $chartLabels[2] }}</span><span>{{ $chartLabels[3] }}</span>
                </div>
            </div>
        </div>

        <!-- Client Report Tab -->
        <div x-show="reportTab === 'clients'" x-cloak>
            <h3 class="text-white font-black uppercase italic text-sm tracking-widest mb-6">Customer Life-time Value (LTV)</h3>
            <div class="overflow-x-auto rounded border border-red-900 bg-black bg-opacity-40">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-red-900 text-[10px] font-black uppercase tracking-widest text-red-500 italic bg-midnight">
                            <th class="px-6 py-4">Client Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Total Visits</th>
                            <th class="px-6 py-4 text-right">Total Spent</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-red-900/20">
                        @foreach ($clientReport as $client)
                        <tr class="hover:bg-red-900/5 transition-colors">
                            <td class="px-6 py-4 text-white font-bold uppercase text-[10px] italic">{{ $client->name }}</td>
                            <td class="px-6 py-4 text-gray-400 text-[10px] italic">{{ $client->email }}</td>
                            <td class="px-6 py-4 text-white text-[10px] font-black italic">{{ $client->appointments_count }}</td>
                            <td class="px-6 py-4 text-right text-red-500 font-black italic text-[10px]">${{ number_format($client->total_spent, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Appointments Report Tab -->
        <div x-show="reportTab === 'appointments'" x-cloak>
            <h3 class="text-white font-black uppercase italic text-sm tracking-widest mb-6">Detailed Appointment Logs</h3>
            <div class="overflow-x-auto rounded border border-red-900 bg-black bg-opacity-40">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-red-900 text-[10px] font-black uppercase tracking-widest text-red-500 italic bg-midnight">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Service</th>
                            <th class="px-6 py-4">Date & Time</th>
                            <th class="px-6 py-4">Revenue</th>
                            <th class="px-6 py-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-red-900/20">
                        @foreach ($data as $appointment)
                        <tr class="hover:bg-red-900/5 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-[9px] font-bold">#{{ $appointment->id }}</td>
                            <td class="px-6 py-4 text-white font-bold uppercase text-[10px] italic">{{ $appointment->customer_name }}</td>
                            @php 
                                $sName = $appointment->service ? $appointment->service->name : ($appointment->service_type ?? 'N/A');
                                $price = $appointment->service ? (float)preg_replace('/[^0-9.]/', '', $appointment->service->price) : 0;
                            @endphp
                            <td class="px-6 py-4 text-gray-300 text-[10px] font-black italic uppercase">{{ $sName }}</td>
                            <td class="px-6 py-4 text-gray-400 text-[9px] font-black italic uppercase">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y - h:i A') }}
                            </td>
                            <td class="px-6 py-4 text-green-500 font-black italic text-[10px]">
                                ${{ in_array(strtolower($appointment->status), ['completed', 'confirmed']) ? number_format($price, 2) : '0.00' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="status-badge status-{{ strtolower($appointment->status) }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>