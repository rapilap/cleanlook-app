<x-app_user title="Courier Home">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Cleanlook</title>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.tailwindcss.com"></script>
<nav class="bg-green-500 text-white py-4 px-6 ">
    <div class="text-2xl font-bold">Cleanlook</div>
</nav>

<div class="text-center mt-4">
        <h2 class="text-lg font-semibold">Halo <span id="user" class="font-bold">user</span>,</h2>
        <p class="text-gray-600"><span id="interactive-text"></span></p>
</div>

<div class="text-center mt-4">
        <p class="text-gray-600"><span id="jadwal-text"></span></p>
</div>

<script>
    const options = {
            strings: ["Semangat dan selamat bekerja dengan cleanlook"],
            typeSpeed: 50
        };
    
    // const option = {
    //     strings: ["Penjumputan hari ini"],
    //     typeSpeed: 50
    //   };

        const typed = new Typed("#interactive-text", options);
        // const typed = new Typed("#jadwal-text",option);

        // Dinamis nama user
        const user = "{{ Auth::user()->name ?? 'user' }}";
        document.getElementById('user').innerText = user;
</script>
</x-app_user>