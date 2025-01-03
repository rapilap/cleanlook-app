<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h2 id="logo" class="text-5xl font-medium transition-all duration-1000">Logo</h2>

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
                    <p>Don't have an account <a href="{{ route('auth.register') }}" class="text-green-400">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk animasi
        window.onload = () => {
            const logo = document.getElementById('logo');
            const loginContainer = document.getElementById('login-container');
            const mainContainer = document.getElementById('main-container');

            // Tunggu 2 detik sebelum animasi dimulai a
            setTimeout(() => {
                // Pindahkan logo ke atas
                logo.classList.add('translate-y-[-200px]', 'scale-75'); // Pindah ke atas dan kecilkan
                logo.classList.remove('translate-y-0');
                
                
                loginContainer.classList.remove('opacity-0', 'translate-y-full');
                loginContainer.classList.add('opacity-100', 'translate-y-0');

              
            }, 300);
        };
    </script>
</body>
</html>
