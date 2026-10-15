<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>500 Gangguan Server · Light And Glow Bukittinggi</title>
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
      <span class="error-eyebrow">Error · Sistem</span>
      <div class="error-code">500</div>
      <h1 class="error-title">Terjadi Kesalahan Server</h1>
      <p class="error-sub">Server mengalami kendala internal sementara. Silakan muat ulang halaman ini atau kembali ke Dashboard.</p>
      <div class="error-actions">
        <a href="javascript:location.reload()" class="btn btn--primary">
          <svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/></svg> Coba Lagi
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn--ghost">
          <svg viewBox="0 0 24 24"><path d="M3 12 12 3l9 9"/><path d="M5 10v10h14V10"/></svg> Dashboard
        </a>
      </div>
      <div class="error-meta">
        <span><strong>STATUS</strong> 500</span>
        <span><strong>CODE</strong> INTERNAL_SERVER_ERROR</span>
        <span><strong>REF</strong> LG-BKT-500</span>
      </div>
    </div>
  </div>
</body>
</html>
