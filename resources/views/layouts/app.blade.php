<body class="font-sans antialiased bg-black">
    <div class="min-h-screen bg-black">
        @include('layouts.navigation')
        @if (isset($header))
            <header class="bg-[#111] shadow border-b border-gray-900">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <main>
            {{ $slot }}
        </main>
    </div>
</body>