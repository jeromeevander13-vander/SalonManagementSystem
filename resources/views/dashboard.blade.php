<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Tonet Salon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-black text-white hidden md:block">
            <div class="p-6">
                <span class="text-xl font-black italic uppercase italic">TONET SALON</span>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 bg-red-600 rounded-lg text-white font-bold">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-900 rounded-lg transition">
                    <i class="fas fa-calendar-alt"></i> Appointments
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-900 rounded-lg transition">
                    <i class="fas fa-users"></i> Staff/Stylists
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-900 rounded-lg transition">
                    <i class="fas fa-cut"></i> Services
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-900 rounded-lg transition">
                    <i class="fas fa-box"></i> Inventory
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-gray-900 rounded-lg transition">
                    <i class="fas fa-chart-line"></i> Sales Reports
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800 uppercase italic">Management Overview</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-500">Welcome, Admin</span>
                    <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-600">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Today's Revenue</p>
                        <h3 class="text-2xl font-black mt-1">₱12,450</h3>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-black">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Pending Appts</p>
                        <h3 class="text-2xl font-black mt-1">14</h3>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Active Stylists</p>
                        <h3 class="text-2xl font-black mt-1">8</h3>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Monthly Growth</p>
                        <h3 class="text-2xl font-black mt-1">+12%</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h4 class="font-black text-lg uppercase italic">Recent Appointments</h4>
                        <button class="bg-black text-white text-xs px-4 py-2 font-bold hover:bg-red-600 transition">View All</button>
                    </div>
                    <div class="overflow-x-auto p-4">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                                    <th class="pb-4">Client Name</th>
                                    <th class="pb-4">Service</th>
                                    <th class="pb-4">Stylist</th>
                                    <th class="pb-4">Time</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold text-gray-700">
                                <tr class="border-b border-gray-50">
                                    <td class="py-4">Juana Dela Cruz</td>
                                    <td class="py-4">Hair Rebond</td>
                                    <td class="py-4">Stylist Maria</td>
                                    <td class="py-4">10:30 AM</td>
                                    <td class="py-4"><span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px]">Confirmed</span></td>
                                    <td class="py-4 text-right">
                                        <button class="text-gray-400 hover:text-black mx-2"><i class="fas fa-edit"></i></button>
                                        <button class="text-gray-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-50">
                                    <td class="py-4">Juan Luna</td>
                                    <td class="py-4">Men's Fade</td>
                                    <td class="py-4">Stylist Rico</td>
                                    <td class="py-4">11:15 AM</td>
                                    <td class="py-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px]">Completed</span></td>
                                    <td class="py-4 text-right">
                                        <button class="text-gray-400 hover:text-black mx-2"><i class="fas fa-edit"></i></button>
                                        <button class="text-gray-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>