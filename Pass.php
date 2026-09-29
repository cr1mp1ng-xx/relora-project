<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Lupa Password - Relora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-light: #E2FBCE;
            --brand: #076653;
            --brand-deep: #0C342C;
            --ink: #0C342C;
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #F3F6F1;
        }

        .scene {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .scene::before {
            content: "";
            position: absolute;
            inset: -10%;
            background:
                radial-gradient(circle at 12% 15%, rgba(7, 102, 83, .10), transparent 40%),
                radial-gradient(circle at 88% 20%, rgba(180, 222, 90, .35), transparent 42%),
                radial-gradient(circle at 20% 88%, rgba(180, 222, 90, .30), transparent 40%),
                radial-gradient(circle at 90% 85%, rgba(7, 102, 83, .12), transparent 45%);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: .5;
        }

        .grid-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(12, 52, 44, .08) 1.4px, transparent 1.4px);
            background-size: 26px 26px;
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
            mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
        }

        .float-icon {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 30px -10px rgba(12, 52, 44, .25);
            animation: bob 6s ease-in-out infinite;
        }

        .float-icon svg {
            stroke: var(--brand);
        }

        @keyframes bob {
            0%,
            100% {
                transform: translateY(0) rotate(var(--r, 0deg));
            }
            50% {
                transform: translateY(-14px) rotate(var(--r, 0deg));
            }
        }

        .card-shadow {
            box-shadow: 0 30px 70px -20px rgba(12, 52, 44, .35);
        }

        .input-field {
            background: #EEF3FB;
        }

        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(7, 102, 83, .18);
        }

        .btn-brand {
            background: linear-gradient(135deg, #0C8F72, #076653);
            transition: .2s;
        }

        .btn-brand:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -8px rgba(7, 102, 83, .5);
        }

        .panel-gradient {
            background: linear-gradient(155deg, #D7F26D 0%, #7CC24A 45%, #0C6B4F 100%);
        }

        .link-brand:hover {
            color: var(--brand);
        }

        [hidden] {
            display: none !important;
        }

        .view {
            animation: swap .35s ease;
        }

        @keyframes swap {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }

        .msg {
            font-size: .8rem;
            border-radius: .75rem;
            padding: .6rem .9rem;
        }

        .msg.error {
            background: #FDECEC;
            color: #B42318;
        }

        .msg.ok {
            background: #E2FBCE;
            color: #0C342C;
        }

        @media (max-width: 480px) {
            .float-icon {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .float-icon,
            .view {
                animation: none;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative">
    <div class="scene">
        <div class="grid-dots"></div>
        <div class="blob" style="width:340px;height:340px; top:-80px; left:-80px; background:radial-gradient(circle,var(--brand-light),transparent 70%);"></div>
        <div class="blob" style="width:280px;height:280px; bottom:-100px; right:-60px; background:radial-gradient(circle,#0C8F72,transparent 70%); opacity:.25;"></div>

        <div class="float-icon" style="width:64px;height:64px; top:9%; left:8%; --r:-8deg; animation-delay:.2s;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="12" rx="1.5" />
                <path d="M2 19h20l-1.5-3h-17z" />
            </svg>
        </div>
        <div class="float-icon" style="width:56px;height:56px; top:16%; right:9%; --r:6deg; animation-delay:1.1s;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8h12l1 12H5z" />
                <path d="M9 8a3 3 0 0 1 6 0" />
            </svg>
        </div>
        <div class="float-icon" style="width:58px;height:58px; bottom:14%; left:7%; --r:5deg; animation-delay:.6s;">
            <svg width="27" height="27" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10 12 5 2 10l10 5 10-5Z" />
                <path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5" />
            </svg>
        </div>
        <div class="float-icon" style="width:54px;height:54px; bottom:10%; right:10%; --r:-6deg; animation-delay:1.6s;">
            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
        </div>
        <div class="float-icon" style="width:46px;height:46px; top:46%; left:4%; --r:10deg; animation-delay:2s;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 7v5l3 3" />
            </svg>
        </div>
        <div class="float-icon" style="width:46px;height:46px; top:40%; right:4%; --r:-10deg; animation-delay:.9s;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="2" width="16" height="20" rx="2" />
                <path d="M8 6h8M8 10h8M8 14h5" />
            </svg>
        </div>
    </div>

    <div class="relative z-10 w-full max-w-[1100px] flex flex-col md:flex-row bg-white rounded-[32px] overflow-hidden card-shadow">
        <div class="w-full md:w-1/2 px-8 sm:px-16 py-14 flex flex-col justify-center">
            <section class="view">
                <h1 class="text-3xl font-bold text-slate-800 text-center mb-3">Lupa Password?</h1>
                <p class="text-center text-sm text-slate-500 mb-8 max-w-[340px] mx-auto">
                    Masukkan email yang kamu pakai untuk mendaftar. Kami akan kirim link untuk membuat password baru.
                </p>

                <form id="form-forgot" class="space-y-5" novalidate>
                    <input name="email" type="email" placeholder="Email" autocomplete="email" class="input-field w-full text-base text-slate-700 px-5 py-4 rounded-xl">

                    <p id="msg-forgot" class="msg" hidden></p>

                    <button type="submit" class="btn-brand w-full text-white text-base font-bold tracking-wide py-4 rounded-xl shadow-md">
                        KIRIM LINK RESET
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-6">
                    Ingat password kamu? <a href="Auth.php" class="font-semibold text-[#076653]">Kembali ke Sign In</a>
                </p>
            </section>
        </div>

        <div class="w-full md:w-1/2 panel-gradient px-12 py-16 hidden md:flex flex-col items-center justify-center text-center relative overflow-hidden">
            <svg class="absolute -bottom-8 -right-8 opacity-20" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="#0C342C" stroke-width="1">
                <path d="M6 8h12l1 12H5z" />
                <path d="M9 8a3 3 0 0 1 6 0" />
            </svg>

            <div class="view relative z-10 flex flex-col items-center">
                <h2 class="text-3xl font-extrabold text-[#0C342C] mb-4">Tenang, Relora`s!</h2>
                <p class="text-base text-[#0C342C]/80 leading-relaxed max-w-[320px]">
                    Lupa password itu biasa. Reset lewat email, lalu kamu bisa lanjut belanja dan jualan bareng sesama mahasiswa.
                </p>
                <a href="Auth.php" class="mt-9 inline-block border-2 border-[#0C342C] text-[#0C342C] text-base font-bold tracking-wide px-10 py-3.5 rounded-xl hover:bg-[#0C342C] hover:text-white transition">
                    SIGN IN
                </a>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('form-forgot');
        const msg = document.getElementById('msg-forgot');

        function message(text, type) {
            msg.textContent = text;
            msg.className = 'msg ' + type;
            msg.hidden = false;
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = form.email.value.trim();
            if (!email) {
                return message('Isi email kamu dulu.', 'error');
            }
            if (!/^\S+@\S+\.\S+$/.test(email)) {
                return message('Format email belum benar.', 'error');
            }
            message('Link reset sudah dikirim ke ' + email + '. Cek inbox atau folder spam.', 'ok');
        });
    </script>
</body>
</html>