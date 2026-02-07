<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-wide">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 border border-gray-700 rounded-xl shadow-lg">
                <div class="p-6 text-gray-200">
                    <h3 class="text-lg font-semibold">
                        👋 {{ __("Welcome back, ") }} {{ Auth::user()->name }}!
                    </h3>
                    <p class="mt-2 text-sm text-gray-400">
                        {{ __("Naka login ka choi! Ready naka mo manage sa system.") }}
                    </p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md hover:shadow-xl transition">
                    <h4 class="text-sm font-medium text-gray-400">Total Rooms</h4>
                    <p class="mt-2 text-3xl font-bold text-indigo-400">12</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md hover:shadow-xl transition">
                    <h4 class="text-sm font-medium text-gray-400">Available Rooms</h4>
                    <p class="mt-2 text-3xl font-bold text-green-400">7</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md hover:shadow-xl transition">
                    <h4 class="text-sm font-medium text-gray-400">Occupied</h4>
                    <p class="mt-2 text-3xl font-bold text-red-400">5</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">
                        🕒 Recent Activity
                    </h3>

                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex justify-between">
                            <span>Room 101 booked</span>
                            <span class="text-gray-500">2 mins ago</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Room 204 marked available</span>
                            <span class="text-gray-500">1 hour ago</span>
                        </li>
                        <li class="flex justify-between">
                            <span>New room added</span>
                            <span class="text-gray-500">Yesterday</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gray-900 border border-gray-800 rounded-xl shadow-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">
                        ⚡ Quick Actions
                    </h3>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('main') }}"
                           class="px-5 py-2 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white transition">
                            View Rooms
                        </a>

                        <a href="{{ route('new') }}"
                           class="px-5 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white transition">
                            Add New Room
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="px-5 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
