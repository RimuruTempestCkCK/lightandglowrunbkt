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
  <title>404 Halaman Tidak Ditemukan · Light And Glow Bukittinggi</title>
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
  <div class="error-shell">
    <div class="error-card">
      <span class="error-eyebrow">Error · Tidak Ditemukan</span>
      <div class="error-code">404</div>
      <h1 class="error-title">Halaman Tidak Ditemukan</h1>
      <p class="error-sub">Halaman yang Anda tuju mungkin sudah dipindahkan, dihapus, atau alamat URL salah. Silakan kembali ke Dashboard atau Landing Page.</p>
      <div class="error-actions">
        <a href="{{ route('dashboard') }}" class="btn btn--primary">
          <svg viewBox="0 0 24 24"><path d="M3 12 12 3l9 9"/><path d="M5 10v10h14V10"/></svg> Ke Dashboard
        </a>
        <a href="{{ url('/') }}" class="btn btn--ghost">
          <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Landing Page
        </a>
      </div>
      <div class="error-meta">
        <span><strong>STATUS</strong> 404</span>
        <span><strong>CODE</strong> NOT_FOUND</span>
        <span><strong>APP</strong> LIGHT & GLOW BUKITTINGGI</span>
      </div>
    </div>
  </div>
</body>
</html>
