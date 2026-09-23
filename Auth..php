<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign In / Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Bagian animasi ini yang agak sulit kalau full pakai utility Tailwind,
           jadi ditulis manual di sini. Sisanya tetap pakai class Tailwind. */
        .auth-container {
            position: relative;
            overflow: hidden;
            width: 850px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-panel {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out, visibility 0.6s;
        }

        .sign-in-panel {
            left: 0;
            z-index: 2;
            opacity: 1;
            visibility: visible;
        }

        .sign-up-panel {
            left: 0;
            z-index: 1;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            background: linear-gradient(135deg, #E2FBCE 0%, #E3EF26 50%, #076653 100%);
            color: #0a3d32;
            transition: transform 0.6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 40px;
            text-align: center;
            height: 100%;
            width: 50%;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .auth-container.right-panel-active .sign-in-panel {
            transform: translateX(100%);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .auth-container.right-panel-active .sign-up-panel {
            transform: translateX(100%);
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            z-index: 5;
        }

        .auth-container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .auth-container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .auth-container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .auth-container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div id="authContainer" class="auth-container bg-white rounded-2xl shadow-2xl">
        <div class="form-panel sign-up-panel">
            <form action="{{ route('register') ?? '#' }}" method="POST"
                  class="h-full flex flex-col items-center justify-center px-10">
                
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Buat Akun</h1>

                <input type="text" name="name" placeholder="Nama Lengkap"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-emerald-600 outline-none">
                <input type="email" name="email" placeholder="Email"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-emerald-600 outline-none">
                <input type="password" name="password" placeholder="Password"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-4 text-sm focus:ring-2 focus:ring-emerald-600 outline-none">

                <button type="submit"
                        class="bg-[#076653] hover:bg-[#054d3f] text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg transition">
                    Sign Up
                </button>

                <span class="text-xs text-gray-500 mt-4 mb-3">atau daftar pakai email</span>

                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="form-panel sign-in-panel">
            <form action="{{ route('login') ?? '#' }}" method="POST"
                  class="h-full flex flex-col items-center justify-center px-10">

                <h1 class="text-2xl font-bold text-gray-800 mb-4">Sign In</h1>

                <input type="email" name="email" placeholder="Email"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-emerald-600 outline-none">
                <input type="password" name="password" placeholder="Password"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-emerald-600 outline-none">

                <a href="#" class="text-xs text-gray-500 mb-4 hover:underline">Lupa Password?</a>

                <button type="submit"
                        class="bg-[#076653] hover:bg-[#054d3f] text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg transition">
                    Sign In
                </button>

                <span class="text-xs text-gray-500 mt-4 mb-3">atau pakai email & password</span>

                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="text-2xl font-bold mb-3">Welcome Relora!</h1>
                    <p class="text-sm text-[#0a3d32]/80 mb-6">
                        Untuk tetap terhubung dengan kami, silakan login dengan akun yang kamu daftarkan.
                    </p>
                    <button type="button" id="btnSignIn"
                            class="border-2 border-[#0a3d32] text-[#0a3d32] text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg hover:bg-[#0a3d32] hover:text-white transition">
                        Sign In
                    </button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1 class="text-2xl font-bold mb-3">Hello, Relora!</h1>
                    <p class="text-sm text-[#0a3d32]/80 mb-6">
                        Daftarkan data diri kamu apabila belum mempunyai akun untuk bisa menikmati semua access.
                    </p>
                    <button type="button" id="btnSignUp"
                            class="border-2 border-[#0a3d32] text-[#0a3d32] text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg hover:bg-[#0a3d32] hover:text-white transition">
                        Sign Up
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        const container = document.getElementById('authContainer');
        document.getElementById('btnSignUp').addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });
        document.getElementById('btnSignIn').addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
</body>
</html>