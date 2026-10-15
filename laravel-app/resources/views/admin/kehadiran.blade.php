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
  <title>Laporan Kehadiran & Check-in · Light And Glow Bukittinggi</title>
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
<body data-active="kehadiran" data-crumbs="Check-in | Laporan Kehadiran">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Audit & Kehadiran</span>
            <h1 class="hero-title">Laporan <span class="accent">Kehadiran Peserta</span></h1>
            <p class="hero-sub">Pantau arus masuk pengunjung konser & pelari night run secara real-time berdasarkan hasil scan validasi QR Code di masing-masing gate petugas.</p>
          </div>
          <div class="hero-actions">
            <a href="{{ route('admin.scanner') }}" class="btn btn--primary">
              <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              Buka Scanner QR
            </a>
          </div>
        </section>

        <!-- Table Kehadiran -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Log Audit Real-time</span>
              <h2 class="card-title">Riwayat Check-in Peserta di Venue Acara</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>Waktu Check-in</th>
                <th>Kode Tiket / Token</th>
                <th>Nama Peserta</th>
                <th>Kategori Tiket</th>
                <th>Gate / Petugas</th>
                <th>Status Validasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>18:32 WIB</strong></td>
                <td><code style="background:var(--bg-muted); padding:2px 6px; border-radius:4px;">LG-BKT-2026-99214</code></td>
                <td>Rian Hidayat</td>
                <td>VIP Glow Run 5K</td>
                <td>Gate 1 (Petugas: Alex)</td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">✓ Check-in Berhasil</span></td>
              </tr>
              <tr>
                <td><strong>18:30 WIB</strong></td>
                <td><code style="background:var(--bg-muted); padding:2px 6px; border-radius:4px;">LG-BKT-2026-77821</code></td>
                <td>Siti Aisyah</td>
                <td>Reguler - 5K Night Run</td>
                <td>Gate 2 (Petugas: Bunga)</td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">✓ Check-in Berhasil</span></td>
              </tr>
              <tr>
                <td><strong>18:28 WIB</strong></td>
                <td><code style="background:var(--bg-muted); padding:2px 6px; border-radius:4px;">LG-BKT-2026-66312</code></td>
                <td>Doni Pratama</td>
                <td>Early Bird - Festival Pass</td>
                <td>Gate 1 (Petugas: Alex)</td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">✓ Check-in Berhasil</span></td>
              </tr>
              <tr>
                <td><strong>18:25 WIB</strong></td>
                <td><code style="background:var(--bg-muted); padding:2px 6px; border-radius:4px;">LG-BKT-2026-66312</code></td>
                <td>Orang Lain (Duplikasi)</td>
                <td>Early Bird Pass</td>
                <td>Gate 2 (Petugas: Bunga)</td>
                <td><span class="tag t-danger" style="background:rgba(235,19,85,0.2); color:#EB1355; padding:3px 8px; border-radius:4px; font-weight:700;">✕ Ditolak: Tiket Sudah Dipakai</span></td>
              </tr>
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>
</body>
</html>
