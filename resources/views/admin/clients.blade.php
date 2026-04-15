<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-white/5 pb-6">
    <div>
        <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-none">Client <span class="text-red-600">Registry</span></h1>
        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] mt-3 flex items-center">
            <span class="w-8 h-[1px] bg-red-600 mr-3"></span>
            Verified Customer Database
        </p>
    </div>
    <div class="flex items-center gap-4">
        <div class="bg-white/5 border border-white/10 px-4 py-2 rounded-lg backdrop-blur-md">
            <span class="text-gray-500 text-[9px] font-black uppercase tracking-widest block">Active Users</span>
            <span class="text-white font-black text-xl leading-none tracking-tighter">{{ count($allClients ?? $clients) }}</span>
        </div>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-900/20 border border-green-900 rounded text-green-500 text-xs font-bold uppercase tracking-widest flex items-center">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-red-900/20 border border-red-900 rounded text-red-500 text-xs font-bold uppercase tracking-widest flex items-center">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    {{ session('error') }}
</div>
@endif

<div class="bg-card-dark border border-red-900 rounded shadow-2xl overflow-hidden">
    <div class="bg-red-900 bg-opacity-40 border-b border-red-900 px-6 py-3 flex justify-between items-center">
        <h3 class="font-black text-white uppercase italic text-[10px] tracking-[0.2em]">All Clients</h3>
        <span class="text-red-500 text-[9px] font-bold uppercase tracking-widest">Page: {{ $clients->currentPage() }} of {{ $clients->lastPage() }}</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-red-900 text-red-500 font-black uppercase italic bg-black bg-opacity-20">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">No-Shows</th>
                    <th class="px-6 py-4">Registered On</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-red-900/30">
                
               @foreach ($clients as $client)
                <tr class="hover:bg-red-900/10 transition {{ $client->is_banned ? 'opacity-50' : '' }}">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-white font-bold italic uppercase">{{ $client->name }}</span>
                            <span class="text-gray-400 text-[9px]">{{ $client->email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($client->is_banned)
                            <span class="bg-red-600 text-white text-[9px] font-black px-2 py-0.5 rounded uppercase">Banned</span>
                        @else
                            <span class="bg-green-600 text-white text-[9px] font-black px-2 py-0.5 rounded uppercase">Active</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-{{ $client->no_show_count > 0 ? 'red' : 'gray' }}-500 font-bold">{{ $client->no_show_count }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-400 italic text-[10px]">{{ $client->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <!-- Ban/Unban Toggle -->
                            <form action="{{ route('admin.clients.ban', $client->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="{{ $client->is_banned ? 'text-white bg-red-600' : 'text-white bg-yellow-600 shadow-lg' }} px-4 py-1.5 rounded text-[9px] font-black uppercase tracking-widest transition active:scale-95" title="{{ $client->is_banned ? 'Unban Client' : 'Ban Client' }}">
                                    {{ $client->is_banned ? 'Lift Ban' : 'Ban Account' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 px-6 pb-6 text-gray-500 font-bold text-[10px] uppercase italic tracking-widest border-t border-red-900/20 pt-4">
        {{ $clients->links() }}
    </div>
</div>