<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-wide">
            {{ __('Beautiful Views') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Hero Section -->
            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                <img
                    src="https://images.unsplash.com/photo-1501785888041-af3ef285b470"
                    alt="Mountain View"
                    class="w-full h-80 object-cover brightness-75"
                >
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 class="text-4xl font-bold text-white drop-shadow-lg">
                        🌄 Explore Beautiful Places
                    </h1>
                </div>
            </div>

            <!-- Intro Text -->
            <div class="text-center">
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Experience breathtaking views from around the world. Relax, explore, and enjoy the beauty —
                    all inside a modern dark-themed interface.
                </p>
            </div>

            <!-- Image Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card 1 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
                        alt="Beach"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">🏖 Tropical Beach</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Crystal-clear water and white sand paradise.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1469474968028-56623f02e42e"
                        alt="Forest"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">🌲 Peaceful Forest</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Calm, green, and full of life.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1491553895911-0055eca6402d"
                        alt="City Night"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">🌃 City at Night</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Neon lights and urban beauty.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                        alt="Sunset"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">🌅 Golden Sunset</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Warm colors painting the sky.
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470"
                        alt="Mountains"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">⛰ Majestic Mountains</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Nature’s power and beauty combined.
                        </p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img
                        src="https://images.unsplash.com/photo-1506744038136-46273834b3fb"
                        alt="Lake"
                        class="h-56 w-full object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white">🏞 Silent Lake</h3>
                        <p class="text-sm text-gray-400 mt-1">
                            Reflection, peace, and serenity.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
