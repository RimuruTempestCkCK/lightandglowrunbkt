<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
  <title>Daftar Akun Baru · Light And Glow Bukittinggi</title>
  <script>
    !function(){
      try{
        var t=localStorage.getItem("dash26-theme"),e=window.matchMedia("(prefers-color-scheme: dark)").matches;
        document.documentElement.setAttribute("data-theme",t||(e?"dark":"light"))
      }catch(t){
        document.documentElement.setAttribute("data-theme","light")
      }
    }()
  </script>
  <script defer="defer" src="{{ asset('adminator/runtime.096d507f.js') }}"></script>
  <script defer="defer" src="{{ asset('adminator/2026.5a84696f.js') }}"></script>
  <link href="{{ asset('adminator/style.76ee5eee.css') }}" rel="stylesheet">
</head>
<body>
  <div class="auth-shell">
    <aside class="auth-aside">
      <div class="auth-brand">
        <div class="logo">
          <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <path fill="#fff" d="M14.747 9.125c.527-1.426 1.736-2.573 3.317-2.573c1.643 0 2.792 1.085 3.318 2.573l6.077 16.867c.186.496.248.931.248 1.147c0 1.209-.992 2.046-2.139 2.046c-1.303 0-1.954-.682-2.264-1.611l-.931-2.915h-8.62l-.93 2.884c-.31.961-.961 1.642-2.232 1.642c-1.24 0-2.294-.93-2.294-2.17c0-.496.155-.868.217-1.023l6.233-16.867zm.34 11.256h5.891l-2.883-8.992h-.062l-2.946 8.992z"/>
          </svg>
        </div>
        <div class="name">Light & Glow</div>
      </div>
      <div class="auth-aside-body">
        <span class="auth-aside-eyebrow">Bukittinggi Event Panel</span>
        <h1>Buat Akun Petugas / Pengguna</h1>
        <p>Bergabunglah dengan tim panitia pelaksana Light And Glow Bukittinggi untuk verifikasi tiket dan pemantauan event secara realtime.</p>
        <div class="auth-quote">
          "Bergabung dalam kemeriahan lari malam dan festival musik terbesar di Bukittinggi."
          <div class="auth-quote-author">
            <div class="av">LG</div>
            <div>Tim Panitia Pelaksana</div>
          </div>
        </div>
      </div>
      <div class="auth-aside-footer">
        <span>© 2026</span> <span>BUKITTINGGI, SUMATERA BARAT</span>
      </div>
    </aside>

    <main class="auth-main">
      <div class="auth-main-top">
        <a href="{{ url('/') }}" style="font-size:12.5px;color:var(--t-muted);display:inline-flex;align-items:center;gap:6px">
          <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg> Kembali ke Landing Page
        </a>
        <div class="switch-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
      </div>

      <div class="auth-card">
        <h2>Buat Akun Anda</h2>
        <p class="sub">Daftar untuk mengakses tiket digital atau hak akses petugas acara.</p>
        
        <form class="auth-form" onsubmit="event.preventDefault(); alert('Pendaftaran akun berhasil!'); window.location='{{ route('login') }}';">
          <div class="field">
            <label class="field-label" for="name">Nama Lengkap</label>
            <input id="name" class="input" type="text" placeholder="Ahmad Fauzan" required>
          </div>

          <div class="field">
            <label class="field-label" for="email">Alamat Email</label>
            <div class="input-icon">
              <span class="ico">
                <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
              </span>
              <input id="email" class="input" type="email" placeholder="nama@email.com" required>
            </div>
          </div>

          <div class="field">
            <label class="field-label" for="phone">Nomor WhatsApp / HP</label>
            <input id="phone" class="input" type="tel" placeholder="081234567890" required>
          </div>

          <div class="field">
            <label class="field-label" for="password">Kata Sandi</label>
            <div class="input-icon">
              <span class="ico">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </span>
              <input id="password" class="input" type="password" placeholder="Minimal 8 karakter" required minlength="8">
            </div>
          </div>

          <label class="check">
            <input type="checkbox" checked="checked" required>
            <span class="box"></span> Saya menyetujui <a href="#" style="color:var(--primary);font-weight:600;">Syarat & Ketentuan</a>
          </label>

          <button class="btn btn--primary auth-submit" type="submit">
            Daftar Sekarang
            <svg viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
          </button>
        </form>
      </div>

      <div class="auth-main-bottom">
        Sudah memiliki tiket? Anda bisa langsung melihat barcode e-tiket setelah masuk.
      </div>
    </main>
  </div>
</body>
</html>
