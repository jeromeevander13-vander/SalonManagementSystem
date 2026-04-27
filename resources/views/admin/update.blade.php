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
            <div class="flex items-center gap-4"># Illuminate\Database\QueryException - Internal Server Error

SQLSTATE[HY000] [1130] Host 'localhost' is not allowed to connect to this MariaDB server (Connection: mysql, Host: localhost, Port: 3306, Database: salon_db, SQL: select * from `sessions` where `id` = 5sEaJSCgtrVG0UMeYuos3bRQGpIaG08EoM3NEQmk limit 1)

PHP 8.2.12
Laravel 12.47.0
127.0.0.1:8000

## Stack Trace

0 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:838
1 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:794
2 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:411
3 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3368
4 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3353
5 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3943
6 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3352
7 - vendor\laravel\framework\src\Illuminate\Database\Concerns\BuildsQueries.php:366
8 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3275
9 - vendor\laravel\framework\src\Illuminate\Session\DatabaseSessionHandler.php:96
10 - vendor\laravel\framework\src\Illuminate\Session\Store.php:126
11 - vendor\laravel\framework\src\Illuminate\Session\Store.php:114
12 - vendor\laravel\framework\src\Illuminate\Session\Store.php:98
13 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:146
14 - vendor\laravel\framework\src\Illuminate\Support\helpers.php:390
15 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:143
16 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:115
17 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:63
18 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
19 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse.php:36
20 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
21 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\EncryptCookies.php:74
22 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
23 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
24 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:821
25 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:800
26 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:764
27 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:753
28 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:200
29 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
30 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
31 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull.php:31
32 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
33 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
34 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TrimStrings.php:51
35 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
36 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePostSize.php:27
37 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
38 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance.php:109
39 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
40 - vendor\laravel\framework\src\Illuminate\Http\Middleware\HandleCors.php:48
41 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
42 - vendor\laravel\framework\src\Illuminate\Http\Middleware\TrustProxies.php:58
43 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
44 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks.php:22
45 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
46 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePathEncoding.php:26
47 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
48 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
49 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:175
50 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:144
51 - vendor\laravel\framework\src\Illuminate\Foundation\Application.php:1220
52 - public\index.php:20
53 - vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php:23

## Request

GET /

## Headers

* **host**: 127.0.0.1:8000
* **connection**: keep-alive
* **sec-ch-ua**: "Microsoft Edge";v="147", "Not.A/Brand";v="8", "Chromium";v="147"
* **sec-ch-ua-mobile**: ?0
* **sec-ch-ua-platform**: "Windows"
* **upgrade-insecure-requests**: 1
* **user-agent**: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0
* **accept**: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
* **sec-fetch-site**: none
* **sec-fetch-mode**: navigate
* **sec-fetch-user**: ?1
* **sec-fetch-dest**: document
* **accept-encoding**: gzip, deflate, br, zstd
* **accept-language**: en-US,en;q=0.9
* **cookie**: XSRF-TOKEN=eyJpdiI6IklMNkdDbFhNSnNDa2Ryb3I5NHJhVGc9PSIsInZhbHVlIjoiZnVaQ1I3cjhHR004Q2JXM2xlQXlrZ0VGUHJPZjBLUzBlYlNCRmFHRFBiWS9zZXEzOHZQYVJuY0p0blhRUHdkMm5lbnlyNDc5YXpKbmZOY2Q1eVRjUHRONC9GT2IvUGRlUUJTUEowdDJWUnhqMGpJVWMrOW5HdWovNTRpTlFLNFgiLCJtYWMiOiJiZTgwNmQwYWNkMDViMDZmZDA4Y2Y3MDlkYjE4YTlkODEyYjFjYTQ3NTQ0ZmZhMzFlZWVjYWZkZTBiZjk3OTY3IiwidGFnIjoiIn0%3D; laravel-session=eyJpdiI6Im4rUW9WSm1VRlZ2M1J6THRjc2Mxcmc9PSIsInZhbHVlIjoiVnByODlUM2ZnS2VESkM3bVVXY21rNFY4N0NrRlUrUTVnWFdkY0ptR3RQU0tUaWtjSlZland3cXpDOVZsUnVvUG1abUF0N0Q0V0NBNUwzcU93WDE1bVo3b1NNU0NIazJyaDAyMU1nc3VYRDRzcTViSjFRNmZKN0Y0cThrZ25MemciLCJtYWMiOiJjNDk4NWM4OGMxYThkZjc5MDcyY2RiYjg5ZjlmN2Q4ZTA4OTI5YjA0NTk3MmQyNjE3MGM5MDk5ZDI5ZTk4YTU4IiwidGFnIjoiIn0%3D

## Route Context

controller: Closure
route name: home
middleware: web

## Route Parameters

No route parameter data available.

## Database Queries

No database queries detected.

                <div class="w-12 h-12 rounded-full border border-red-900 overflow-hidden flex items-center justify-center bg-black">
                    @if($appointment->user?->avatar)
                        <img src="{{ asset('storage/' . $appointment->user?->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-black italic">{{ substr($appointment->customer_name, 0, 1) }}</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-white text-2xl font-black uppercase tracking-tighter">Edit Session</h2>
                    <p class="text-gray-500 text-[10px] mt-1 uppercase tracking-widest">{{ $appointment->customer_name }} • ID: #{{ $appointment->id }}</p>
                </div>
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
                            class="w-full bg-[#111] border border-red-900/40 rounded-lg p-3 text-white text-sm focus:border-red-600 focus:ring-1 focus:ring-red-600/20 outline-none transition-all cursor-pointer">
                            <option value="09:00:00">09:00 AM</option>
                            <option value="10:00:00">10:00 AM</option>
                            <option value="11:00:00">11:00 AM</option>
                            <option value="12:00:00">12:00 PM</option>
                            <option value="13:00:00">01:00 PM</option>
                            <option value="14:00:00">02:00 PM</option>
                            <option value="15:00:00">03:00 PM</option>
                            <option value="16:00:00">04:00 PM</option>
                            <option value="17:00:00">05:00 PM</option>
                            <option value="18:00:00">06:00 PM</option>
                            <option value="19:00:00">07:00 PM</option>
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