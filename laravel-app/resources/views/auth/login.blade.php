<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal Admin & Petugas · Light And Glow Bukittinggi</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;700&family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
  <style>
    .auth-admin-page {
      min-height: 100vh;
      display: flex;
      background: #F8FAFC;
    }
    .auth-admin-left {
      flex: 1;
      background: linear-gradient(145deg, #0B132B 0%, #1C2541 60%, #3A506B 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 64px 56px;
      color: #fff;
      position: relative;
      overflow: hidden;
    }
    .auth-admin-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=800&q=40') center/cover no-repeat;
      opacity: 0.10;
    }
    .auth-admin-left > * { position: relative; z-index: 1; }
    .auth-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(56, 189, 248, 0.15);
      border: 1px solid rgba(56, 189, 248, 0.35);
      border-radius: 999px;
      padding: 6px 14px;
      font-size: 12px;
      font-weight: 700;
      color: #38BDF8;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 20px;
    }
    .auth-left-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 34px;
      font-weight: 800;
      line-height: 1.25;
      margin-bottom: 14px;
    }
    .auth-left-title span { color: #38BDF8; }
    .auth-left-desc {
      font-size: 14px;
      color: rgba(255,255,255,0.75);
      line-height: 1.6;
      max-width: 380px;
      margin-bottom: 30px;
    }
    .auth-left-features { display: flex; flex-direction: column; gap: 12px; }
    .auth-left-feature {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 13px;
      color: rgba(255,255,255,0.9);
    }
    .auth-left-feature span {
      width: 30px; height: 30px;
      background: rgba(56, 189, 248, 0.15);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      font-size: 15px; flex-shrink: 0;
    }
    @media (max-width: 820px) {
      .auth-admin-left { display: none; }
    }

    .auth-admin-right {
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
      max-width: 420px;
      display: flex;
      flex-direction: column;
    }
    @media (max-width: 820px) {
      .auth-admin-right { padding: 32px 20px; }
      .auth-form-container { max-width: 100%; }
    }

    .auth-back-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 13px; color: var(--goers-gray-600);
      margin-bottom: 28px;
      transition: color 0.2s;
    }
    .auth-back-link:hover { color: var(--goers-branding-500); }

    .auth-form-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 24px; font-weight: 800;
      color: var(--goers-navy-900);
      margin-bottom: 6px;
    }
    .auth-form-sub {
      font-size: 13px; color: var(--goers-gray-700);
      margin-bottom: 28px; line-height: 1.5;
    }

    .form-field { margin-bottom: 18px; }
    .form-label {
      display: block;
      font-size: 13px; font-weight: 700;
      color: var(--goers-navy-900);
      margin-bottom: 6px;
    }
    .form-input {
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
    .form-input:focus {
      border-color: #0284C7;
      box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
    }

    .form-submit-btn {
      width: 100%;
      padding: 13px;
      background: #0F172A;
      color: #fff;
      font-weight: 800;
      font-size: 14px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
      transition: background 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 10px;
    }
    .form-submit-btn:hover {
      background: #1E293B;
    }

    .auth-divider {
      display: flex; align-items: center; gap: 12px;
      color: var(--goers-gray-500); font-size: 12px;
      margin: 22px 0 16px;
    }
    .auth-divider::before, .auth-divider::after {
      content: ''; flex: 1;
      height: 1px; background: var(--goers-gray-300);
    }

    .quick-roles {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }
    .role-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 10px 12px;
      border: 1px solid var(--goers-gray-300);
      border-radius: 10px;
      font-size: 12px;
      font-weight: 700;
      color: var(--goers-navy-900);
      background: #F8FAFC;
      transition: all 0.2s;
      text-decoration: none;
    }
    .role-btn:hover {
      border-color: #0284C7;
      color: #0284C7;
      background: #F0F9FF;
    }
  </style>
</head>
<body>
  <div class="auth-admin-page">
    
    <!-- Panel Kiri (Ringkas, Clean) -->
    <div class="auth-admin-left">
      <div class="auth-badge">
        🛡️ Portal Internal Event
      </div>
      <h1 class="auth-left-title">
        Akses Admin &<br><span>Petugas Scanner</span>
      </h1>
      <p class="auth-left-desc">
        Masuk untuk memverifikasi pembayaran pesanan tiket dan melakukan pemindaian check-in tiket peserta.
    </div>

    <!-- Panel Kanan (Form Rapi di Tengah) -->
    <div class="auth-admin-right">
      <div class="auth-form-container">
        <a href="{{ route('home') }}" class="auth-back-link">
          <i data-lucide="arrow-left" style="width:15px;height:15px;"></i>
          Kembali ke Beranda
        </a>

        <h2 class="auth-form-title">Masuk ke Portal</h2>
        <p class="auth-form-sub">Masukkan kredensial akun panitia pelaksana Anda.</p>

        <form method="GET" action="{{ route('admin.dashboard') }}" onsubmit="event.preventDefault(); window.location='{{ route('admin.dashboard') }}';">
          <div class="form-field">
            <label class="form-label" for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              class="form-input"
              placeholder="admin@lightandglow.id"
              value="admin@lightandglow.id"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-label" for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              class="form-input"
              placeholder="••••••••"
              value="password123"
              required
            />
          </div>

          <button type="submit" class="form-submit-btn">
            <i data-lucide="log-in" style="width:16px;height:16px;"></i>
            Masuk ke Dashboard
          </button>
        </form>

        <div class="auth-divider">atau akses cepat</div>

        <div class="quick-roles">
          <a class="role-btn" href="{{ route('admin.dashboard') }}">
            <i data-lucide="layout-dashboard" style="width:15px;height:15px;color:#0284C7;"></i>
            Admin Utama
          </a>
          <a class="role-btn" href="{{ route('petugas.dashboard') }}">
            <i data-lucide="qr-code" style="width:15px;height:15px;color:#10B981;"></i>
            Petugas Scan
          </a>
        </div>
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
