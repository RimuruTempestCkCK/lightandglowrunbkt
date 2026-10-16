<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk Akun Pembeli · Light And Glow Bukittinggi 2026</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;700&family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
  <style>
    .auth-buyer-page {
      min-height: 100vh;
      display: flex;
      background: #F8FAFC;
    }
    .auth-buyer-left {
      flex: 1;
      background: linear-gradient(145deg, #070B19 0%, #0F172A 40%, #023E8A 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 64px 56px;
      color: #fff;
      position: relative;
      overflow: hidden;
      border-right: 1px solid rgba(0, 229, 255, 0.2);
    }
    .auth-buyer-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('{{ asset('poster-lightandglowrun.jpeg') }}') center/cover no-repeat;
      opacity: 0.25;
    }
    .auth-buyer-left > * { position: relative; z-index: 1; }
    .auth-left-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 229, 255, 0.15);
      border: 1px solid rgba(0, 229, 255, 0.4);
      border-radius: 999px;
      padding: 6px 14px;
      font-size: 12px;
      font-weight: 700;
      color: #00E5FF;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 24px;
      box-shadow: 0 0 14px rgba(0, 229, 255, 0.3);
    }
    .auth-left-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 38px;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 16px;
    }
    .auth-left-title span {
      color: #00E5FF;
      text-shadow: 0 0 16px rgba(0, 229, 255, 0.6);
    }
    .auth-left-desc {
      font-size: 15px;
      color: rgba(255,255,255,0.75);
      line-height: 1.7;
      max-width: 360px;
      margin-bottom: 40px;
    }
    .auth-left-features { display: flex; flex-direction: column; gap: 12px; }
    .auth-left-feature {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 14px;
      color: rgba(255,255,255,0.85);
    }
    .auth-left-feature span {
      width: 32px; height: 32px;
      background: rgba(235,19,85,0.2);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; flex-shrink: 0;
    }
    @media (max-width: 768px) {
      .auth-buyer-left { display: none; }
    }

    .auth-buyer-right {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 48px 32px;
      background: #fff;
      overflow-y: auto;
    }
    .auth-form-container {
      width: 100%;
      max-width: 440px;
      display: flex;
      flex-direction: column;
    }
    @media (max-width: 768px) {
      .auth-buyer-right { padding: 32px 20px; }
      .auth-form-container { max-width: 100%; }
    }
    .auth-buyer-logo {
      display: flex; align-items: center; gap: 10px;
      font-family: 'Montserrat', sans-serif;
      font-weight: 800; font-size: 22px;
      color: var(--goers-navy-900);
      margin-bottom: 40px;
    }
    .auth-buyer-logo .dot { color: var(--goers-branding-500); }
    .auth-form-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 26px; font-weight: 800;
      color: var(--goers-navy-900);
      margin-bottom: 6px;
    }
    .auth-form-sub {
      font-size: 14px; color: var(--goers-gray-700);
      margin-bottom: 32px; line-height: 1.5;
    }

    .buyer-form-field { margin-bottom: 18px; }
    .buyer-form-label {
      display: block;
      font-size: 13px; font-weight: 700;
      color: var(--goers-navy-900);
      margin-bottom: 6px;
    }
    .buyer-form-input {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid var(--goers-gray-400);
      border-radius: 10px;
      font-size: 14px;
      font-family: inherit;
      color: var(--goers-gray-900);
      background: #fff;
      transition: border-color 0.2s;
      outline: none;
    }
    .buyer-form-input:focus {
      border-color: #00B4D8;
      box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.18);
    }
    .buyer-form-input.is-error { border-color: #EF4444; }

    .buyer-form-error {
      font-size: 12px; color: #EF4444; font-weight: 600;
      margin-top: 4px; display: block;
    }
    .buyer-form-submit {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, #00E5FF 0%, #00B4D8 100%);
      color: #070B19;
      font-weight: 800; font-size: 15px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
      letter-spacing: 0.02em;
      transition: all 0.2s, transform 0.1s;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      margin-top: 8px;
      box-shadow: 0 4px 14px rgba(0, 229, 255, 0.35);
    }
    .buyer-form-submit:hover {
      background: linear-gradient(135deg, #76FF03 0%, #00E5FF 100%);
      box-shadow: 0 6px 20px rgba(118, 255, 3, 0.45);
      color: #070B19;
    }
    .buyer-form-submit:active { transform: scale(0.99); }

    .auth-divider {
      display: flex; align-items: center; gap: 12px;
      color: var(--goers-gray-500); font-size: 12px;
      margin: 20px 0;
    }
    .auth-divider::before, .auth-divider::after {
      content: ''; flex: 1;
      height: 1px; background: var(--goers-gray-300);
    }
    .auth-switch-link {
      text-align: center; font-size: 14px;
      color: var(--goers-gray-700);
    }
    .auth-switch-link a {
      color: var(--goers-branding-500); font-weight: 700;
    }
    .auth-back-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 13px; color: var(--goers-gray-600);
      margin-bottom: 32px;
      transition: color 0.2s;
    }
    .auth-back-link:hover { color: var(--goers-branding-500); }

    .alert-error {
      background: #FEF2F2; border: 1px solid #FECACA;
      border-radius: 10px; padding: 12px 14px;
      font-size: 13px; color: #B91C1C;
      margin-bottom: 20px;
      display: flex; align-items: flex-start; gap: 10px;
    }
    .alert-success {
      background: #F0FDF4; border: 1px solid #BBF7D0;
      border-radius: 10px; padding: 12px 14px;
      font-size: 13px; color: #166534;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="auth-buyer-page">

    <!-- Left Panel -->
    <div class="auth-buyer-left">
      <div class="auth-left-badge">
        🎟️ Tiket Resmi · Light & Glow 2026
      </div>
      <h1 class="auth-left-title">
        Event Spektakuler<br>di <span>Jam Gadang</span><br>Bukittinggi!
      </h1>
    </div>

    <!-- Right Panel / Form -->
    <div class="auth-buyer-right">
      <div class="auth-form-container">
        <a href="{{ route('home') }}" class="auth-back-link">
          <i data-lucide="arrow-left" style="width:15px;height:15px;"></i>
          Kembali ke Beranda
        </a>

        <div class="auth-buyer-logo" style="margin-bottom:28px;">
          <a href="{{ route('home') }}" style="display:inline-flex; align-items:center; gap:10px;">
            <img src="{{ asset('logo-lightandrun.png') }}" alt="Light and Glow" style="height:44px; width:auto; filter:drop-shadow(0 2px 8px rgba(0,229,255,0.4));" />
            <span style="font-weight:800; font-size:20px; color:var(--goers-navy-900);">LIGHT & GLOW<span style="color:#00B4D8;">.</span></span>
          </a>
        </div>

        <h2 class="auth-form-title">Masuk ke Akun Anda</h2>
        <p class="auth-form-sub">Login untuk memesan tiket, melihat e-tiket, dan riwayat transaksi Anda.</p>

        {{-- Alert Errors --}}
        @if($errors->any())
          <div class="alert-error">
            <i data-lucide="alert-circle" style="width:16px;height:16px;flex-shrink:0;margin-top:1px;"></i>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        @if(session('success'))
          <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('buyer.login.post') }}">
          @csrf

          <div class="buyer-form-field">
            <label class="buyer-form-label" for="email">Email Akun Anda</label>
            <input
              type="email"
              id="email"
              name="email"
              class="buyer-form-input {{ $errors->has('email') ? 'is-error' : '' }}"
              placeholder="contoh: rian@gmail.com"
              value="{{ old('email') }}"
              required
            />
            @error('email')<span class="buyer-form-error">{{ $message }}</span>@enderror
          </div>

          <div class="buyer-form-field">
            <label class="buyer-form-label" for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              class="buyer-form-input {{ $errors->has('password') ? 'is-error' : '' }}"
              placeholder="Masukkan password Anda"
              required
            />
            @error('password')<span class="buyer-form-error">{{ $message }}</span>@enderror
          </div>

          <button type="submit" class="buyer-form-submit">
            <i data-lucide="log-in" style="width:16px;height:16px;"></i>
            Masuk & Pesan Tiket
          </button>
        </form>

        <div class="auth-divider">belum punya akun?</div>

        <div class="auth-switch-link">
          <a href="{{ route('buyer.register') }}" style="display:inline-flex;align-items:center;gap:6px;background:var(--goers-branding-100);color:var(--goers-branding-500);padding:10px 20px;border-radius:10px;font-weight:700;font-size:14px;width:100%;justify-content:center;">
            <i data-lucide="user-plus" style="width:16px;height:16px;"></i>
            Daftar Akun Baru (Gratis)
          </a>
        </div>

        {{--
        <div style="margin-top:24px; text-align:center; font-size:12px; color:var(--goers-gray-600);">
          Ini adalah akun pembeli tiket Light & Glow. Untuk Portal Admin/Panitia →
          <a href="{{ route('login') }}" style="color:var(--goers-branding-500); font-weight:700;">Masuk di sini</a>
        </div>
        --}}
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide) lucide.createIcons();
    });
  </script>
</body>
</html>
