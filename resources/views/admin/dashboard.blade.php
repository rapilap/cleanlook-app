<x-app title="Dashboard" bodyClass="bg-primary items-center">
    <div class="min-h-screen flex flex-col items-center w-full">
        <!-- Logo Section -->
        <div class="w-full h-fit py-3 bg-primary flex justify-center items-center">
            <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="rounded-full max-h-full max-w-28">
        </div>

        <!-- Search Box -->
        <div class="w-4/5 my-5">
            <input 
                type="text" 
                placeholder="Search" 
                class="w-full p-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <!-- Cards Section -->
        <div class="grid grid-cols-2 gap-4 w-4/5">
            <div class="h-24 bg-white rounded-lg shadow-md"></div>
            <div class="h-24 bg-white rounded-lg shadow-md"></div>
            <div class="h-24 bg-white rounded-lg shadow-md"></div>
            <div class="h-24 bg-white rounded-lg shadow-md"></div>
        </div>

        <!-- Overview Section -->
        <div class="w-4/5 mt-5">
            <h3 class="text-lg font-semibold mb-3">Overview</h3>
            <div class="h-52 bg-white rounded-lg shadow-md"></div>
        </div>
    </div>
</x-app>
