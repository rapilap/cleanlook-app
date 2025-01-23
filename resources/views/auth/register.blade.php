<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes slideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes expandBackground {
            from {
                height: 0;
            }
            to {
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="main-container" class="bg-green-300 w-full h-screen flex flex-col justify-center items-center relative overflow-hidden">
        <!-- Logo Section -->
        <img id="logo" src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="h-20 w-20  rounded-full mr-2  transition-all duration-1000">

        <!-- Login Section -->

        <div id="login-container" class="bg-gray-200 h-[60%] w-full rounded-t-xl opacity-0 translate-y-full absolute bottom-0 transition-all duration-1000">
            <h2 class="p-3 text-xl font-medium w-full text-center">Login ke Akun Anda!</h2>
            <form action="{{ route('login') }}" method="POST" class="bg-white flex pt-10 flex-col px-12 gap-12 rounded-t-3xl justify-center">
                @csrf
                <div class="flex flex-col gap-8">
                    <input type="email" name="email" id="email" class="border w-full border-black hover:border-primary p-2 rounded-lg" placeholder="Email">
                    <div class="flex flex-row gap-4">
                        <input type="password" name="password" id="password" class="border w-full p-2 rounded-lg border-black hover:border-primary" placeholder="Password">
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center w-full">
                    <x-button variant='tertiery' class="w-3/6" type="submit">Login</x-button>
                </div>
            </form>
            <div class="flex flex-col h-full w-full pt-5 bg-white text-center gap-2">
                <p>Belum punya akun? <button onclick="switchToRegister()" class="text-green-400">Daftar di sini!</button></p>
                <p>Anda kurir? <a href="/courier" class="text-green-400">Login di sini!</a></p>
            </div>
        </div>
        
        {{-- <div id="courier-container" class="bg-gray-200 h-[60%] w-full rounded-t-xl opacity-0 translate-y-full absolute bottom-0 transition-all duration-1000">
            <h2 class="p-3 text-xl font-medium w-full text-center">Login ke Akun Kurir Anda!</h2>
            <form action="{{ route('courier.login') }}" method="POST" class="bg-white flex pt-10 flex-col px-12 gap-12 rounded-t-3xl justify-center">
                @csrf
                <div class="flex flex-col gap-8">
                    <input type="email" name="email" id="email" class="border w-full border-slate-800 p-2 rounded" placeholder="Email">
                    <input type="password" name="password" id="password" class="border w-full p-2 rounded border-slate-800" placeholder="Password">
                </div>
                <div class="flex flex-col items-center justify-center">
                    <button class="py-2 w-1/2 rounded-lg bg-green-600 text-white" type="submit">Login</button>
                </div>
            </form>
            <p class="flex flex-col h-full w-full pt-3 bg-white text-center">Anda customer? <button onclick="switchToLogin()" class="text-green-400">Login di sini!</button></p>
        </div> --}}
        
        <div id="register-container" 
             class="bg-gray-200 h-[60%] w-full rounded-t-xl opacity-0 translate-y-full absolute bottom-0 transition-all duration-1000">
             <h2 class="p-3 text-xl font-medium w-full text-center">Daftar Akun Baru!</h2>
            <form action="{{ route('register') }}" method="post" class="bg-white flex pt-10 flex-col px-12 gap-12 rounded-t-3xl justify-center">
                @csrf
                <div class="flex flex-col gap-4">
                    <input type="text" class="border w-full p-2 rounded-lg border-black hover:border-primary" name="name" id="name" placeholder="Nama" required>
                    <input type="email" class="border w-full p-2 rounded-lg border-black hover:border-primary" name="email" id="email" placeholder="Email" required>
                    <input type="password" class="border w-full p-2 rounded-lg border-black hover:border-primary" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="flex flex-col items-center justify-center gap-2 w-full">
                    <x-button variant='tertiery' class="w-3/6" type="submit">Daftar</x-button>
                </div>
            </form>
            <p class="flex flex-col h-full w-full pt-3 bg-white text-center">Sudah punya akun? <button onclick="switchToLogin()" class="text-green-400">Login di sini!</button></p>
        </div>
    </div>

    <script>
        function switchToRegister() {
            const logo = document.getElementById('logo');
            const loginContainer = document.getElementById('login-container');
            const registerContainer = document.getElementById('register-container');
            const mainContainer = document.getElementById('main-container');
            // const courierContainer = document.getElementById('courier-container');

                // Pindahkan logo ke atas
                logo.classList.remove('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                
                // Animasi login container muncul dari bawah
                loginContainer.classList.add('opacity-0', 'translate-y-full');
                // courierContainer.classList.add('opacity-0', 'translate-y-full');
                
                setTimeout(() => {
                    logo.classList.add('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                    
                    registerContainer.classList.remove('opacity-0', 'translate-y-full');
                    registerContainer.classList.add('opacity-100', 'translate-y-0');
                }, 1000)            
        } 

        function switchToLogin() {
            const logo = document.getElementById('logo');
            const loginContainer = document.getElementById('login-container');
            const registerContainer = document.getElementById('register-container');
            const mainContainer = document.getElementById('main-container');
            // const courierContainer = document.getElementById('courier-container');

                // Pindahkan logo ke atas
                logo.classList.remove('translate-y-[-200px]' , 'scale-75'); // Pindah ke atas dan kecilkan
                
                // Animasi login container muncul dari bawah
                registerContainer.classList.add('opacity-0', 'translate-y-full');
                // courierContainer.classList.add('opacity-0', 'translate-y-full');
                
                setTimeout(() => {
                    logo.classList.add('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                    
                    loginContainer.classList.remove('opacity-0', 'translate-y-full');
                    loginContainer.classList.add('opacity-100', 'translate-y-0');
                }, 1000)            
        } 
       
        // function switchToCourier() {
        //     const logo = document.getElementById('logo');
        //     const loginContainer = document.getElementById('login-container');
        //     const registerContainer = document.getElementById('register-container');
        //     const courierContainer = document.getElementById('courier-container');

        //     // Ubah action form menjadi ke /courier/login
        //     const courierForm = courierContainer.querySelector('form');
        //     courierForm.action = '/courier'; // Ubah ke rute login kurir

        //     // Animasi dan transisi antar form
        //     logo.classList.remove('translate-y-[-200px]', 'scale-75');
        //     registerContainer.classList.add('opacity-0', 'translate-y-full');
        //     loginContainer.classList.add('opacity-0', 'translate-y-full');
        //     setTimeout(() => {
        //         logo.classList.add('translate-y-[-200px]', 'scale-75');
        //         courierContainer.classList.remove('opacity-0', 'translate-y-full');
        //         courierContainer.classList.add('opacity-100', 'translate-y-0');
        //     }, 1000);
        // }


        // Script untuk animasi
        window.onload = () => {
            const logo = document.getElementById('logo');
            const loginContainer = document.getElementById('login-container');
            const mainContainer = document.getElementById('main-container');

            // Tunggu 2 detik sebelum animasi dimulai
            setTimeout(() => {
                // Pindahkan logo ke atas
                logo.classList.add('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                logo.classList.remove('translate-y-0');
                
                // Animasi login container muncul dari bawah
                loginContainer.classList.remove('opacity-0', 'translate-y-full');
                loginContainer.classList.add('opacity-100', 'translate-y-0');

                // Ubah background hijau menjadi putih
                // mainContainer.classList.remove('bg-green-300');
                // mainContainer.classList.add('bg-white');
            }, 300);
        };
    </script>
</body>
</html>
