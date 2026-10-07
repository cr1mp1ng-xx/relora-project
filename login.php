<!DOCTYPE html>
<html lang="id">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Sign In - Relora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #076653;
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }
 
        * { font-family: 'Poppins', sans-serif; }
        body { background: #F3F6F1; }
        [hidden] { display: none !important; }
 
        /* ---------- Latar ---------- */
        .scene { position: fixed; inset: 0; overflow: hidden; z-index: 0; }
        .scene::before {
            content: ""; position: absolute; inset: -10%;
            background:
                radial-gradient(circle at 12% 15%, rgba(7,102,83,.10), transparent 40%),
                radial-gradient(circle at 88% 20%, rgba(180,222,90,.35), transparent 42%),
                radial-gradient(circle at 20% 88%, rgba(180,222,90,.30), transparent 40%),
                radial-gradient(circle at 90% 85%, rgba(7,102,83,.12), transparent 45%);
        }
        .blob { position: absolute; border-radius: 50%; filter: blur(2px); opacity: .5; }
        .grid-dots {
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(12,52,44,.08) 1.4px, transparent 1.4px);
            background-size: 26px 26px;
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
            mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
        }
        .float-icon {
            position: absolute; display: flex; align-items: center; justify-content: center;
            background: #fff; border-radius: 18px;
            box-shadow: 0 10px 30px -10px rgba(12,52,44,.25);
            animation: bob 6s ease-in-out infinite;
        }
        .float-icon svg { stroke: var(--brand); }
        @keyframes bob {
            0%, 100% { transform: translateY(0) rotate(var(--r, 0deg)); }
            50% { transform: translateY(-14px) rotate(var(--r, 0deg)); }
        }
        @media (max-width: 480px) { .float-icon { display: none; } }
 
        /* ---------- Komponen ---------- */
        .card-shadow { box-shadow: 0 30px 70px -20px rgba(12,52,44,.35); }
        .input-field { background: #EEF3FB; transition: box-shadow .2s; }
        .input-field:focus { outline: none; box-shadow: 0 0 0 3px rgba(7,102,83,.18); }
        .btn-brand { background: linear-gradient(135deg, #0C8F72, #076653); transition: .2s; }
        .btn-brand:hover { transform: translateY(-1px); box-shadow: 0 10px 20px -8px rgba(7,102,83,.5); }
        .panel-gradient { background: linear-gradient(155deg, #D7F26D 0%, #7CC24A 45%, #0C6B4F 100%); }
        .link-brand:hover { color: var(--brand); }
        .msg { font-size: .8rem; border-radius: .75rem; padding: .6rem .9rem; }
        .msg.error { background: #FDECEC; color: #B42318; }
        .msg.ok { background: #E2FBCE; color: #0C342C; }
 
        /*
         * ANIMASI: satu variabel --p (0 = Sign In, 1 = Sign Up) diubah JS tiap frame.
         * Semua elemen menghitung posisi & transparansinya dari --p,
         * jadi selalu sinkron dan bisa berbalik arah mulus kalau diklik di tengah jalan.
         */
        #card { --p: 0; isolation: isolate; transform: translateZ(0); }
 
        /* Layer yang tidak aktif (transparan) tidak boleh menutupi / menangkap klik */
        #card[data-mode="signin"] .pane-up,
        #card[data-mode="signin"] .promo-up,
        #card[data-mode="signup"] .pane-in,
        #card[data-mode="signup"] .promo-in { pointer-events: none; }
 
        /* Mobile: dua form saling geser + fade, tinggi ikut berubah halus */
        .stage {
            position: relative; overflow: hidden;
            height: calc((var(--h1, 600) * (1 - var(--p)) + var(--h2, 600) * var(--p)) * 1px);
        }
        .pane { position: absolute; top: 0; left: 0; width: 100%; padding: 3.5rem 2rem; will-change: transform, opacity; }
        @media (min-width: 640px) { .pane { padding-inline: 4rem; } }
        .pane-in { opacity: clamp(0, calc((.6 - var(--p)) * 3), 1); transform: translateX(calc(var(--p) * -36px)); }
        .pane-up { opacity: clamp(0, calc((var(--p) - .4) * 3), 1); transform: translateX(calc((1 - var(--p)) * 36px)); }
 
        /* Desktop: panel hijau geser menutupi / membuka form */
        @media (min-width: 768px) {
            #card { min-height: 700px; }
            .stage { position: static; overflow: visible; height: auto; }
            .pane { display: flex; flex-direction: column; justify-content: center; bottom: 0; width: 50%; }
            .pane-up { left: 50%; }
            .pane-in { opacity: clamp(0, calc((.55 - var(--p)) * 5), 1); }
            .pane-up { opacity: clamp(0, calc((var(--p) - .45) * 4), 1); }
 
            /* Panel menyempit di tengah perjalanan (--s = sin(pi*p)), sisi dalamnya melengkung besar */
            .overlay {
                position: absolute; top: 0; height: 100%;
                width: calc(50% * (1 - .22 * var(--s, 0)));
                left: calc(75% - 50% * var(--p) - 25% * (1 - .22 * var(--s, 0)));
                z-index: 5; overflow: hidden; will-change: left, width;
                border-radius:
                    calc(var(--rl, 0) * 1px) calc(var(--rr, 0) * 1px) calc(var(--rr, 0) * 1px) calc(var(--rl, 0) * 1px) /
                    calc(var(--rl, 0) * 1.25px) calc(var(--rr, 0) * 1.25px) calc(var(--rr, 0) * 1.25px) calc(var(--rl, 0) * 1.25px);
            }
            /* Lebar isi promo dikunci setengah kartu supaya teks tidak berpindah baris saat panel menyempit */
            .promo {
                position: absolute; top: 0; bottom: 0; left: 50%;
                width: calc(var(--cw, 1100) * .5px); margin-left: calc(var(--cw, 1100) * -.25px);
                padding: 4rem 3rem;
                display: flex; flex-direction: column; align-items: center; justify-content: center;
                text-align: center; will-change: transform, opacity;
            }
            .promo-in { opacity: clamp(0, calc((.4 - var(--p)) * 5), 1); transform: translateX(calc(var(--p) * -30px)); }
            .promo-up { opacity: clamp(0, calc((var(--p) - .55) * 4), 1); transform: translateX(calc((1 - var(--p)) * 30px)); }
        }
    </style>
</head>
 
<body class="min-h-screen flex items-center justify-center p-4 relative">
    <div class="scene">
        <div class="grid-dots"></div>
        <div class="blob" style="width:340px;height:340px;top:-80px;left:-80px;background:radial-gradient(circle,#E2FBCE,transparent 70%);"></div>
        <div class="blob" style="width:280px;height:280px;bottom:-100px;right:-60px;background:radial-gradient(circle,#0C8F72,transparent 70%);opacity:.25;"></div>
 
        <div class="float-icon" style="width:64px;height:64px;top:9%;left:8%;--r:-8deg;animation-delay:.2s;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="1.5" /><path d="M2 19h20l-1.5-3h-17z" /></svg>
        </div>
        <div class="float-icon" style="width:56px;height:56px;top:16%;right:9%;--r:6deg;animation-delay:1.1s;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l1 12H5z" /><path d="M9 8a3 3 0 0 1 6 0" /></svg>
        </div>
        <div class="float-icon" style="width:58px;height:58px;bottom:14%;left:7%;--r:5deg;animation-delay:.6s;">
            <svg width="27" height="27" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z" /><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5" /></svg>
        </div>
        <div class="float-icon" style="width:54px;height:54px;bottom:10%;right:10%;--r:-6deg;animation-delay:1.6s;">
            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" /></svg>
        </div>
        <div class="float-icon" style="width:46px;height:46px;top:46%;left:4%;--r:10deg;animation-delay:2s;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg>
        </div>
        <div class="float-icon" style="width:46px;height:46px;top:40%;right:4%;--r:-10deg;animation-delay:.9s;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" /><path d="M8 6h8M8 10h8M8 14h5" /></svg>
        </div>
    </div>
 
    <main id="card" class="relative z-10 w-full max-w-[1100px] bg-white rounded-[32px] overflow-hidden card-shadow">
        <div class="stage">
            <section id="pane-signin" class="pane pane-in">
                <h1 class="text-3xl font-bold text-slate-800 text-center mb-9">Sign In</h1>
 
                <form id="form-signin" class="space-y-5" novalidate>
                    <input name="identity" type="text" placeholder="Username / Email" autocomplete="username" class="input-field w-full text-base text-slate-700 px-5 py-4 rounded-xl">
                    <input name="password" type="password" placeholder="Password" autocomplete="current-password" class="input-field w-full text-base text-slate-700 px-5 py-4 rounded-xl">
                    <div class="text-center"><a href="lupass.php" class="text-sm text-slate-500 link-brand">Lupa Password?</a></div>
                    <p id="msg-signin" class="msg" hidden></p>
                    <button type="submit" class="btn-brand w-full text-white text-base font-bold tracking-wide py-4 rounded-xl shadow-md">SIGN IN</button>
                </form>
 
                <p class="text-center text-sm text-slate-400 mt-6 mb-4">atau pakai akun lain</p>
                <div class="flex justify-center gap-4">
                    <button type="button" aria-label="Google" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
                        <svg width="19" height="19" viewBox="0 0 24 24"><path fill="#EA4335" d="M12 10.2v3.9h5.5c-.24 1.4-1.7 4.1-5.5 4.1-3.3 0-6-2.7-6-6.2s2.7-6.2 6-6.2c1.9 0 3.1.8 3.9 1.5l2.6-2.6C16.9 3.2 14.7 2.2 12 2.2 6.9 2.2 2.8 6.4 2.8 12s4.1 9.8 9.2 9.8c5.3 0 8.8-3.7 8.8-9 0-.6-.1-1.1-.2-1.6H12z" /></svg>
                    </button>
                    <button type="button" aria-label="Facebook" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.16 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.9h-2.34V22c4.78-.78 8.44-4.93 8.44-9.94z" /></svg>
                    </button>
                </div>
 
                <p class="text-center text-sm text-slate-500 mt-6 md:hidden">
                    Belum punya akun? <a href="#signup" data-go="signup" class="font-semibold text-[#076653]">Sign Up</a>
                </p>
            </section>
 
            <section id="pane-signup" class="pane pane-up">
                <h1 class="text-3xl font-bold text-slate-800 text-center mb-8">Sign Up</h1>
 
                <form id="form-signup" class="space-y-4" novalidate>
                    <input name="nama" type="text" placeholder="Nama" autocomplete="name" class="input-field w-full text-base text-slate-700 px-5 py-3.5 rounded-xl">
                    <input name="email" type="email" placeholder="Email" autocomplete="email" class="input-field w-full text-base text-slate-700 px-5 py-3.5 rounded-xl">
                    <input name="password" type="password" placeholder="Password (min. 8 karakter)" autocomplete="new-password" class="input-field w-full text-base text-slate-700 px-5 py-3.5 rounded-xl">
                    <input name="password2" type="password" placeholder="Konfirmasi Password" autocomplete="new-password" class="input-field w-full text-base text-slate-700 px-5 py-3.5 rounded-xl">
                    <label class="flex items-start gap-2 text-sm text-slate-500">
                        <input name="setuju" type="checkbox" class="mt-1 accent-[#076653]">
                        <span>Saya setuju dengan syarat & ketentuan Relora.</span>
                    </label>
                    <p id="msg-signup" class="msg" hidden></p>
                    <button type="submit" class="btn-brand w-full text-white text-base font-bold tracking-wide py-4 rounded-xl shadow-md">SIGN UP</button>
                </form>
 
                <p class="text-center text-sm text-slate-500 mt-6 md:hidden">
                    Sudah punya akun? <a href="#signin" data-go="signin" class="font-semibold text-[#076653]">Sign In</a>
                </p>
            </section>
        </div>
 
        <aside class="overlay panel-gradient hidden md:block">
            <svg class="absolute -bottom-8 -right-8 opacity-20" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="#0C342C" stroke-width="1"><path d="M6 8h12l1 12H5z" /><path d="M9 8a3 3 0 0 1 6 0" /></svg>
 
            <div id="promo-signin" class="promo promo-in">
                <h2 class="text-3xl font-extrabold text-[#0C342C] mb-4">Hello, Relora`s!</h2>
                <p class="text-base text-[#0C342C]/80 leading-relaxed max-w-[320px]">Daftarkan data diri kamu apabila belum mempunyai akun untuk bisa menikmati dan menggunakan Relora yang dimana menjadi tempat COD para mahasiswa.</p>
                <button type="button" data-go="signup" class="mt-9 border-2 border-[#0C342C] text-[#0C342C] text-base font-bold tracking-wide px-10 py-3.5 rounded-xl hover:bg-[#0C342C] hover:text-white transition">SIGN UP</button>
            </div>
 
            <div id="promo-signup" class="promo promo-up">
                <h2 class="text-3xl font-extrabold text-[#0C342C] mb-4">Welcome Back Relora`s!</h2>
                <p class="text-base text-[#0C342C]/80 leading-relaxed max-w-[320px]">Sudah punya akun Relora belum nih? Kalau belum yuk masuk untuk bisa belanja dan jualan bareng dengan sesama mahasiswa.</p>
                <button type="button" data-go="signin" class="mt-9 border-2 border-[#0C342C] text-[#0C342C] text-base font-bold tracking-wide px-10 py-3.5 rounded-xl hover:bg-[#0C342C] hover:text-white transition">SIGN IN</button>
            </div>
        </aside>
    </main>
 
    <script>
        const $ = (id) => document.getElementById(id);
        const card = $('card');
        const panes = { signin: $('pane-signin'), signup: $('pane-signup') };
        const promos = { signin: $('promo-signin'), signup: $('promo-signup') };
        const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)');
 
        const DURATION = 850; 
        const RESPECT_REDUCED_MOTION = false;
        const ease = (t) => t < .5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2; // easeInOutCubic
 
        let p = 0, raf = 0, cw = 1100;
 
        function render(v) {
            p = v;
            const s = Math.sin(Math.PI * v);          
            const R = cw * .165;                      
            const extra = 40 * s * (cw / 1100);       
            const rl = R * Math.pow(1 - v, 2.2) + extra;
            const rr = R * Math.pow(v, 2.2) + extra;
            const st = card.style;
            st.setProperty('--p', v.toFixed(4));
            st.setProperty('--s', s.toFixed(4));
            st.setProperty('--rl', rl.toFixed(1));
            st.setProperty('--rr', rr.toFixed(1));
        }
 
        function measure() {
            cw = card.offsetWidth;
            card.style.setProperty('--cw', cw);
            card.style.setProperty('--h1', panes.signin.offsetHeight);
            card.style.setProperty('--h2', panes.signup.offsetHeight);
            render(p);
        }
        addEventListener('resize', measure);
 
        function go(mode, animate = true) {
            const up = mode === 'signup';
            const to = up ? 1 : 0;
 
            for (const k of ['signin', 'signup']) {
                const on = (k === 'signup') === up;
                panes[k].inert = !on;
                promos[k].inert = !on;
            }
            card.dataset.mode = mode;
            document.title = (up ? 'Sign Up' : 'Sign In') + ' - Relora';
            try { history.replaceState(null, '', '#' + mode); } catch (_) { /* diabaikan di lingkungan preview/sandbox */ }
 
            cancelAnimationFrame(raf);
            const from = p;
            const dist = Math.abs(to - from);
            if (!animate || !dist || (RESPECT_REDUCED_MOTION && reduceMotion.matches)) return render(to);
 
            const dur = DURATION * dist;
            const t0 = performance.now();
            const tick = (now) => {
                const t = Math.min((now - t0) / dur, 1);
                render(from + (to - from) * ease(t));
                if (t < 1) raf = requestAnimationFrame(tick);
            };
            raf = requestAnimationFrame(tick);
 
            if (innerWidth < 768) scrollTo({ top: 0, behavior: 'smooth' });
        }
 
        document.querySelectorAll('[data-go]').forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                go(el.dataset.go);
            });
        });
 
        measure();
        new ResizeObserver(measure).observe(panes.signin);
        new ResizeObserver(measure).observe(panes.signup);
        go(location.hash === '#signup' ? 'signup' : 'signin', false);
        addEventListener('hashchange', () => go(location.hash === '#signup' ? 'signup' : 'signin'));

        function message(el, text, type) {
            el.textContent = text;
            el.className = 'msg ' + type;
            el.hidden = false;
        }
 
        $('form-signin').addEventListener('submit', (e) => {
            e.preventDefault();
            const f = e.target, msg = $('msg-signin');
            if (!f.identity.value.trim() || !f.password.value) {
                return message(msg, 'Isi username/email dan password dulu.', 'error');
            }
            message(msg, 'Berhasil masuk. (Hubungkan ke backend kamu di sini.)', 'ok');
        });
 
        $('form-signup').addEventListener('submit', (e) => {
            e.preventDefault();
            const f = e.target, msg = $('msg-signup');
            if (!f.nama.value.trim() || !f.email.value.trim() || !f.password.value) {
                return message(msg, 'Lengkapi semua data dulu.', 'error');
            }
            if (!/^\S+@\S+\.\S+$/.test(f.email.value)) {
                return message(msg, 'Format email belum benar.', 'error');
            }
            if (f.password.value.length < 8) {
                return message(msg, 'Password minimal 8 karakter.', 'error');
            }
            if (f.password.value !== f.password2.value) {
                return message(msg, 'Konfirmasi password tidak sama.', 'error');
            }
            if (!f.setuju.checked) {
                return message(msg, 'Centang persetujuan syarat & ketentuan.', 'error');
            }
            message(msg, 'Akun berhasil dibuat. Silakan Sign In.', 'ok');
            setTimeout(() => {
                f.reset();
                msg.hidden = true;
                go('signin');
            }, 1200);
        });
    </script>
</body>
 
</html>
