<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Sign In - Relora</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --brand-light:#E2FBCE; --brand:#076653; --brand-deep:#0C342C; --ink:#0C342C;
    padding-top:env(safe-area-inset-top,0px); padding-bottom:env(safe-area-inset-bottom,0px);
  }
  *{font-family:'Poppins',sans-serif;}
  body{ background:#F3F6F1; }

  /* Scattered scene behind the card */
  .scene{ position:fixed; inset:0; overflow:hidden; z-index:0; }
  .scene::before{
    content:""; position:absolute; inset:-10%;
    background:
      radial-gradient(circle at 12% 15%, rgba(7,102,83,.10), transparent 40%),
      radial-gradient(circle at 88% 20%, rgba(180,222,90,.35), transparent 42%),
      radial-gradient(circle at 20% 88%, rgba(180,222,90,.30), transparent 40%),
      radial-gradient(circle at 90% 85%, rgba(7,102,83,.12), transparent 45%);
  }
  .blob{ position:absolute; border-radius:50%; filter:blur(2px); opacity:.5; }
  .grid-dots{
    position:absolute; inset:0;
    background-image: radial-gradient(rgba(12,52,44,.08) 1.4px, transparent 1.4px);
    background-size: 26px 26px;
    -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
            mask-image: radial-gradient(ellipse 70% 60% at 50% 45%, black 15%, transparent 72%);
  }
  .float-icon{
    position:absolute; display:flex; align-items:center; justify-content:center;
    background:#fff; border-radius:18px; box-shadow:0 10px 30px -10px rgba(12,52,44,.25);
    animation: bob 6s ease-in-out infinite;
  }
  .float-icon svg{ stroke:var(--brand); }
  @keyframes bob{ 0%,100%{ transform:translateY(0) rotate(var(--r,0deg)); } 50%{ transform:translateY(-14px) rotate(var(--r,0deg)); } }

  .tag{ position:absolute; font-weight:700; font-size:.65rem; color:var(--brand-deep);
    background:var(--brand-light); border:1.5px dashed var(--brand); padding:.3rem .6rem; border-radius:999px;
    animation: bob 7s ease-in-out infinite; }

  .card-shadow{ box-shadow: 0 30px 70px -20px rgba(12,52,44,.35); }
  .input-field{ background:#EEF3FB; }
  .input-field:focus{ outline:none; box-shadow:0 0 0 3px rgba(7,102,83,.18); }
  .btn-brand{ background:linear-gradient(135deg,#0C8F72,#076653); transition:.2s; }
  .btn-brand:hover{ transform:translateY(-1px); box-shadow:0 10px 20px -8px rgba(7,102,83,.5); }
  .panel-gradient{ background:linear-gradient(155deg,#D7F26D 0%, #7CC24A 45%, #0C6B4F 100%); }

  @media (max-width: 480px){ .float-icon, .tag{ display:none; } }
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">

  <!-- Decorative background: kampus + jualan online vibe -->
  <div class="scene">
    <div class="grid-dots"></div>
    <div class="blob" style="width:340px;height:340px; top:-80px; left:-80px; background:radial-gradient(circle,var(--brand-light),transparent 70%);"></div>
    <div class="blob" style="width:280px;height:280px; bottom:-100px; right:-60px; background:radial-gradient(circle,#0C8F72,transparent 70%); opacity:.25;"></div>

    <!-- floating icon chips: laptop, shopping bag, graduation cap, chat -->
    <div class="float-icon" style="width:64px;height:64px; top:9%; left:8%; --r:-8deg; animation-delay:.2s;">
      <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="1.5"/><path d="M2 19h20l-1.5-3h-17z"/></svg>
    </div>
    <div class="float-icon" style="width:56px;height:56px; top:16%; right:9%; --r:6deg; animation-delay:1.1s;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l1 12H5z"/><path d="M9 8a3 3 0 0 1 6 0"/></svg>
    </div>
    <div class="float-icon" style="width:58px;height:58px; bottom:14%; left:7%; --r:5deg; animation-delay:.6s;">
      <svg width="27" height="27" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
    </div>
    <div class="float-icon" style="width:54px;height:54px; bottom:10%; right:10%; --r:-6deg; animation-delay:1.6s;">
      <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
    </div>
    <div class="float-icon" style="width:46px;height:46px; top:46%; left:4%; --r:10deg; animation-delay:2s;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
    </div>
    <div class="float-icon" style="width:46px;height:46px; top:40%; right:4%; --r:-10deg; animation-delay:.9s;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M8 6h8M8 10h8M8 14h5"/></svg>
    </div>

    <span class="tag" style="top:28%; left:20%; animation-delay:.3s;">Cash on Delivery</span>
    <span class="tag" style="top:8%; left:38%; animation-delay:1.4s;">Diskon Mahasiswa</span>
    <span class="tag" style="bottom:26%; right:22%; animation-delay:.8s;">Jual Cepat, Laku!</span>
  </div>

  <!-- Sign In Card -->
  <div class="relative z-10 w-full max-w-[1100px] flex flex-col md:flex-row bg-white rounded-[32px] overflow-hidden card-shadow">

    <!-- Left: form -->
    <div class="w-full md:w-1/2 px-10 sm:px-16 py-16 flex flex-col justify-center">
      <h1 class="text-3xl font-bold text-slate-800 text-center mb-9">Sign In</h1>

      <form class="space-y-5" onsubmit="event.preventDefault();">
        <input type="text" placeholder="Username / Email" class="input-field w-full text-base text-slate-700 px-5 py-4 rounded-xl">
        <input type="password" placeholder="Password" class="input-field w-full text-base text-slate-700 px-5 py-4 rounded-xl">

        <div class="text-center">
          <a href="#" class="text-sm text-slate-500 hover:text-brand-dark">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-brand w-full text-white text-base font-bold tracking-wide py-4 rounded-xl shadow-md">
          SIGN IN
        </button>
      </form>

      <p class="text-center text-sm text-slate-400 mt-6 mb-4">atau pakai email &amp; password</p>

      <div class="flex justify-center gap-4">
        <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
          <svg width="19" height="19" viewBox="0 0 24 24"><path fill="#EA4335" d="M12 10.2v3.9h5.5c-.24 1.4-1.7 4.1-5.5 4.1-3.3 0-6-2.7-6-6.2s2.7-6.2 6-6.2c1.9 0 3.1.8 3.9 1.5l2.6-2.6C16.9 3.2 14.7 2.2 12 2.2 6.9 2.2 2.8 6.4 2.8 12s4.1 9.8 9.2 9.8c5.3 0 8.8-3.7 8.8-9 0-.6-.1-1.1-.2-1.6H12z"/></svg>
        </button>
        <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.16 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.9h-2.34V22c4.78-.78 8.44-4.93 8.44-9.94z"/></svg>
        </button>
        <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="#0A66C2"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.86 0-2.15 1.45-2.15 2.94v5.67H9.34V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.38-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45z"/></svg>
        </button>
      </div>
    </div>

    <!-- Right: promo panel -->
    <div class="w-full md:w-1/2 panel-gradient px-12 py-16 flex flex-col items-center justify-center text-center relative overflow-hidden">
      <svg class="absolute -bottom-8 -right-8 opacity-20" width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="#0C342C" stroke-width="1"><path d="M6 8h12l1 12H5z"/><path d="M9 8a3 3 0 0 1 6 0"/></svg>
      <h2 class="text-3xl font-extrabold text-[#0C342C] mb-4 relative z-10">Hello, Relora!</h2>
      <p class="text-base text-[#0C342C]/80 leading-relaxed max-w-[320px] relative z-10">
        Daftarkan data diri kamu apabila belum mempunyai akun untuk bisa menikmati dan menggunakan Relora — marketplace COD favorit mahasiswa.
      </p>
      <button class="relative z-10 mt-9 border-2 border-[#0C342C] text-[#0C342C] text-base font-bold tracking-wide px-10 py-3.5 rounded-xl hover:bg-[#0C342C] hover:text-white transition">
        SIGN UP
      </button>
    </div>
  </div>

</body>
</html>