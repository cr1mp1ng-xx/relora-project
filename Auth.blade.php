<!-- resources/views/auth/auth.blade.php -->
<!-- Halaman Sign In / Sign Up dengan panel overlay yang geser + tukar warna -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign In / Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
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
            transition: all 0.6s ease-in-out;
        }

        .sign-in-panel {
            left: 0;
            z-index: 2;
        }

        .sign-up-panel {
            left: 0;
            z-index: 1;
            opacity: 0;
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
            background: linear-gradient(to right, #6d28d9, #4c1d95);
            color: #fff;
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

        /* Saat mode Sign Up aktif */
        .auth-container.right-panel-active .sign-in-panel {
            transform: translateX(100%);
        }

        .auth-container.right-panel-active .sign-up-panel {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
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

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div id="authContainer" class="auth-container bg-white rounded-2xl shadow-2xl">
        <div class="form-panel sign-up-panel">
            <form action="{{ route('register') ?? '#' }}" method="POST"
                  class="h-full flex flex-col items-center justify-center px-10">
                @csrf
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Buat Akun</h1>

                <div class="flex gap-3 mb-4">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <i class="fa-brands fa-google-plus-g"></i>G+
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">f</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">in</a>
                </div>

                <span class="text-xs text-gray-500 mb-3">atau daftar pakai email</span>

                <input type="text" name="name" placeholder="Nama Lengkap"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                <input type="email" name="email" placeholder="Email"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                <input type="password" name="password" placeholder="Password"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-4 text-sm focus:ring-2 focus:ring-purple-500 outline-none">

                <button type="submit"
                        class="bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg transition">
                    Sign Up
                </button>
            </form>
        </div>

        {{-- ============ FORM SIGN IN ============ --}}
        <div class="form-panel sign-in-panel">
            <form action="{{ route('login') ?? '#' }}" method="POST"
                  class="h-full flex flex-col items-center justify-center px-10">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Sign In</h1>

                <div class="flex gap-3 mb-4">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">G+</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">f</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">gh</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50">in</a>
                </div>

                <span class="text-xs text-gray-500 mb-3">atau pakai email & password</span>

                <input type="email" name="email" placeholder="Email"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                <input type="password" name="password" placeholder="Password"
                       class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 mb-3 text-sm focus:ring-2 focus:ring-purple-500 outline-none">

                <a href="#" class="text-xs text-gray-500 mb-4 hover:underline">Lupa Password?</a>

                <button type="submit"
                        class="bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg transition">
                    Sign In
                </button>
            </form>
        </div>

        {{-- ============ OVERLAY (panel ungu yang geser) ============ --}}
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="text-2xl font-bold mb-3">Welcome Back!</h1>
                    <p class="text-sm text-purple-100 mb-6">
                        Untuk tetap terhubung dengan kami, silakan login dengan data akun kamu
                    </p>
                    <button type="button" id="btnSignIn"
                            class="border-2 border-white text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg hover:bg-white hover:text-purple-700 transition">
                        Sign In
                    </button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1 class="text-2xl font-bold mb-3">Hello, Friend!</h1>
                    <p class="text-sm text-purple-100 mb-6">
                        Daftarkan data diri kamu untuk bisa menikmati semua fitur di aplikasi ini
                    </p>
                    <button type="button" id="btnSignUp"
                            class="border-2 border-white text-white text-sm font-semibold uppercase tracking-wide px-10 py-3 rounded-lg hover:bg-white hover:text-purple-700 transition">
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