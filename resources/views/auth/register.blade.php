<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Register</title>
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
        <div id="login-container" 
             class="bg-gray-200 h-[60%] w-full rounded-t-xl opacity-0 translate-y-full absolute bottom-0 transition-all duration-1000">
             <h2 class="p-3 text-xl font-medium w-full text-center">Login To Your Account</h2>
            <div class="bg-white flex h-full flex-col px-12 py-12 gap-12 rounded-t-3xl justify-center">
                <div class="flex flex-col gap-8">
                    <input type="text" class="border border-slate-800 p-2 rounded" placeholder="Username">
                    <input type="password" class="border p-2 rounded border-slate-800" placeholder="Password">
                </div>
                <div class="flex flex-col items-center justify-center gap-2">
                    <button class="py-2 w-1/2 rounded-lg bg-green-600 text-white">Login</button>
                    <p>Don't have an account <button onclick="switchToRegister()" class="text-green-400">Register Here</button></p>
                </div>
            </div>
        </div>

        <div id="register-container" 
             class="bg-gray-200 h-[60%] w-full rounded-t-xl opacity-0 translate-y-full absolute bottom-0 transition-all duration-1000">
             <h2 class="p-3 text-xl font-medium w-full text-center">Create New Account</h2>
            <div class="bg-white flex h-full flex-col px-12 py-12 gap-10 rounded-t-3xl justify-center">
                <div class="flex flex-col gap-6">
                    <input type="text" class="border border-slate-800 p-2 rounded" placeholder="Username">
                    <input type="password" class="border p-2 rounded border-slate-800" placeholder="Password">
                    <input type="email" class="border p-2 rounded border-slate-800" placeholder="Email">
                </div>
                <div class="flex flex-col items-center justify-center gap-2">
                    <button class="py-2 w-1/2 rounded-lg bg-green-600 text-white">Register</button>
                    <p>You have an account <button onclick="switchToLogin()" class="text-green-400">Login Here</button></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchToRegister() {
            const logo = document.getElementById('logo');
            const loginContainer = document.getElementById('login-container');
            const registerContainer = document.getElementById('register-container');
            const mainContainer = document.getElementById('main-container');

                // Pindahkan logo ke atas
                logo.classList.remove('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                
                // Animasi login container muncul dari bawah
                loginContainer.classList.add('opacity-0', 'translate-y-full');
                
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

                // Pindahkan logo ke atas
                logo.classList.remove('translate-y-[-200px]' , 'scale-75'); // Pindah ke atas dan kecilkan
                
                // Animasi login container muncul dari bawah
                registerContainer.classList.add('opacity-0', 'translate-y-full');
                
                setTimeout(() => {
                    logo.classList.add('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                    
                    loginContainer.classList.remove('opacity-0', 'translate-y-full');
                    loginContainer.classList.add('opacity-100', 'translate-y-0');
                }, 1000)            
        } 

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
