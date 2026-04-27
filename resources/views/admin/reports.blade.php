<div class="mb-8 border-b border-white/5 pb-6">
    <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-none">Analytics & <span class="text-red-600">Reports</span></h1>
    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] mt-3 flex items-center">
        <span class="w-8 h-[1px] bg-red-600 mr-3"></span>
        Business Performance Tracking & Insights
    </p>
</div>

<div class="bg-card-dark border border-red-900 rounded p-6 mb-8 shadow-2xl">
    <form action="{{ route('admin_main') }}" method="GET" class="flex flex-wrap items-end gap-6">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase rounded-lg">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-[10px] font-black text-red-500 uppercase mb-2">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-black border border-red-900 text-white text-xs p-2 focus:ring-1 focus:ring-red-500 outline-none transition uppercase rounded-lg">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-black uppercase italic text-xs px-8 py-2.5 rounded-lg transition shadow-lg active:scale-95">
                Filter Results
            </button>
            <a href="{{ route('admin_main') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-400 font-black uppercase italic text-xs px-8 py-2.5 rounded-lg transition active:scale-95">
                Clear
            </a>
        </div>
    </form>
</div>

<div class="bg-card-dark border border-red-900 rounded-2xl shadow-2xl overflow-hidden" x-data="{ reportTab: localStorage.getItem('reportTab') || 'sales' }" x-init="$watch('reportTab', val => localStorage.setItem('reportTab', val))">
    <div class="flex border-b border-red-900 bg-black bg-opacity-40 p-2 gap-2">
        <button @click="reportTab = 'sales'" :class="reportTab === 'sales' ? 'text-white bg-red-600 shadow-lg' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest transition rounded-xl outline-none">Sales Report</button>
        <button @click="reportTab = 'clients'" :class="reportTab === 'clients' ? 'text-white bg-red-600 shadow-lg' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest transition rounded-xl outline-none">Client Report</button>
        <button @click="reportTab = 'appointments'" :class="reportTab === 'appointments' ? 'text-white bg-red-600 shadow-lg' : 'text-gray-500 hover:text-gray-300'" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest transition rounded-xl outline-none">Appointments Report</button>
    </div>

    <div class="p-8">
        <!-- Sales Report Tab -->
        <div x-show="reportTab === 'sales'">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-black bg-opacity-30 border border-white/5 p-6 rounded-2xl relative overflow-hidden shadow-inner">
                    <div class="absolute top-0 right-0 p-2 opacity-10 text-4xl italic font-black">₱₱₱</div>
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1 tracking-widest">Gross Revenue</p>
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">₱{{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="bg-black bg-opacity-30 border border-white/5 p-6 rounded-2xl relative overflow-hidden shadow-inner">
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1 tracking-widest">Growth Forecast</p>
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">+12.5%</h3>
                </div>
                <div class="bg-black bg-opacity-30 border border-white/5 p-6 rounded-2xl relative overflow-hidden shadow-inner">
                    <p class="text-red-500 text-[10px] font-black uppercase mb-1 tracking-widest">Avg per Visit</p>
                    @php 
                        $avg = $totalAppointments > 0 ? $totalSales / $totalAppointments : 0;
                    @endphp
                    <h3 class="text-3xl font-black text-white italic tracking-tighter">₱{{ number_format($avg, 2) }}</h3>
                </div>
            </div>

            <h2 class="text-white font-black uppercase italic text-lg mb-6 flex items-center">
                <span class="w-4 h-[1px] bg-red-600 mr-2"></span>
                Revenue Overview
            </h2>
            
            <div class="lg:col-span-2 premium-glass rounded-[2rem] p-10 relative overflow-hidden chart-3d-scene mb-12">
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <h2 class="text-white font-black uppercase italic text-lg flex items-center tracking-widest">
                        <span class="w-8 h-[2px] bg-red-600 mr-4 shadow-[0_0_10px_#ff3131]"></span>
                        Revenue Velocity
                    </h2>
                </div>

                @php
                    $maxSales = max(collect($chartData)->max(), 1);
                    $y1 = 256 - (($chartData[0] / $maxSales) * 180) - 40;
                    $y2 = 256 - (($chartData[1] / $maxSales) * 180) - 40;
                    $y3 = 256 - (($chartData[2] / $maxSales) * 180) - 40;
                    $y4 = 256 - (($chartData[3] / $maxSales) * 180) - 40;
                @endphp

                <div class="relative h-72 w-full chart-3d-surface rounded-2xl p-6 border border-white/5 overflow-hidden group">
                    <!-- 3D Grid Floor -->
                    <div class="absolute inset-0 grid-3d pointer-events-none opacity-10"></div>

                    <svg viewBox="0 0 1000 256" preserveAspectRatio="none" class="absolute inset-0 w-full h-full p-6 overflow-visible">
                        <defs>
                            <linearGradient id="repLineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff3131" />
                                <stop offset="100%" stop-color="#8b0000" />
                            </linearGradient>
                            <linearGradient id="repFillGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#ff3131" stop-opacity="0.3" />
                                <stop offset="100%" stop-color="#ff3131" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                        
                        <!-- Area Fill -->
                        <path d="M0,{{ $y1 }} C166,{{ $y1 }} 166,{{ $y2 }} 333,{{ $y2 }} C500,{{ $y2 }} 500,{{ $y3 }} 666,{{ $y3 }} C833,{{ $y3 }} 833,{{ $y4 }} 1000,{{ $y4 }} V256 H0 Z" 
                              fill="url(#repFillGrad)" class="transition-all duration-1000" />
                        
                        <!-- Main Path -->
                        <path d="M0,{{ $y1 }} C166,{{ $y1 }} 166,{{ $y2 }} 333,{{ $y2 }} C500,{{ $y2 }} 500,{{ $y3 }} 666,{{ $y3 }} C833,{{ $y3 }} 833,{{ $y4 }} 1000,{{ $y4 }}" 
                              fill="none" stroke="url(#repLineGrad)" stroke-width="6" stroke-linecap="round" class="animate-flow" style="filter: drop-shadow(0 0 12px #ff3131);" />
                    </svg>
                    
                    <!-- Indicators -->
                    <div class="absolute" style="top: {{ $y1 + 14 }}px; left: 24px;"><div class="w-4 h-4 bg-white rounded-full border-4 border-red-600 shadow-[0_0_15px_#ff3131]"></div></div>
                    <div class="absolute" style="top: {{ $y2 + 14 }}px; left: calc(33.3% + 18px);"><div class="w-4 h-4 bg-white rounded-full border-4 border-red-600 shadow-[0_0_15px_#ff3131]"></div></div>
                    <div class="absolute" style="top: {{ $y3 + 14 }}px; left: calc(66.6% + 10px);"><div class="w-4 h-4 bg-white rounded-full border-4 border-red-600 shadow-[0_0_15px_#ff3131]"></div></div>
                    <div class="absolute" style="top: {{ $y4 + 14 }}px; right: 24px;"><div class="w-4 h-4 bg-white rounded-full border-4 border-red-600 shadow-[0_0_20px_#ff3131] animate-[pulse-glow_2s_infinite]"></div></div>
                </div>
                <div class="flex justify-between mt-10 text-[10px] text-gray-500 font-black uppercase italic tracking-[0.4em] px-10 relative z-10">
                    <span>{{ $chartLabels[0] }}</span><span>{{ $chartLabels[1] }}</span><span>{{ $chartLabels[2] }}</span><span class="text-red-500">{{ $chartLabels[3] }}</span>
                </div>
            </div>
        </div>

        <!-- Client Report Tab -->
        <div x-show="reportTab === 'clients'" x-cloak>
            <h3 class="text-white font-black uppercase italic text-sm tracking-widest mb-6">Customer Life-time Value (LTV)</h3>
            <div class="overflow-x-auto rounded-xl border border-red-900/30 bg-black bg-opacity-40">
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
                            <td class="px-6 py-4 text-right text-red-500 font-black italic text-[10px]">₱{{ number_format($client->total_spent, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $clients->links() }}
            </div>
        </div>

        <!-- Appointments Report Tab -->
        <div x-show="reportTab === 'appointments'" x-cloak>
            <h3 class="text-white font-black uppercase italic text-sm tracking-widest mb-6">Detailed Appointment Logs</h3>
            <div class="overflow-x-auto rounded-xl border border-red-900/30 bg-black bg-opacity-40">
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
                                ₱{{ in_array(strtolower($appointment->status), ['completed', 'confirmed']) ? number_format($price, 2) : '0.00' }}
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
            <div class="mt-8">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>