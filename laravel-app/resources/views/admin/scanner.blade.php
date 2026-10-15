<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>Scanner QR Code Tiket · Light And Glow Bukittinggi</title>
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
  <style>
    .scanner-box {
      max-width: 520px;
      margin: 0 auto;
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 16px;
      padding: 24px;
      text-align: center;
    }
    .viewfinder {
      width: 100%;
      height: 280px;
      background: #000;
      border-radius: 12px;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .scan-laser {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: #EB1355;
      box-shadow: 0 0 12px #EB1355;
      animation: scanAnim 2.5s infinite alternate ease-in-out;
    }
    @keyframes scanAnim {
      0% { top: 5%; }
      100% { top: 95%; }
    }
    .scan-reticle {
      width: 180px;
      height: 180px;
      border: 2px dashed rgba(255,255,255,0.6);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
    }
    .scan-result-card {
      background: var(--bg-body);
      border-radius: 10px;
      padding: 16px;
      margin-top: 16px;
      display: none;
      text-align: left;
    }
  </style>
</head>
<body data-active="scanner" data-crumbs="Check-in | Scanner QR Code Petugas">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Petugas Lapangan</span>
            <h1 class="hero-title">Scanner <span class="accent">QR Code Tiket</span></h1>
            <p class="hero-sub">Pindai QR Code tiket peserta saat acara berlangsung. Sistem memvalidasi keaslian, status bayar, dan mencegah penggunaan ulang tiket yang sama.</p>
          </div>
        </section>

        <div class="scanner-box">
          <div class="viewfinder">
            <div class="scan-laser"></div>
            <div class="scan-reticle">
              <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="1.5">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
              </svg>
            </div>
            <span style="font-size:12px; margin-top:10px; color:#A1A1AA;">Arahkan kamera ke QR Code tiket peserta</span>
          </div>

          <div style="display:flex; gap:10px; justify-content:center; margin-bottom:16px;">
            <button class="btn btn--primary" onclick="simulateScan('valid')">
              Simulasi Tiket VALID
            </button>
            <button class="btn btn--ghost" style="color:var(--danger);" onclick="simulateScan('used')">
              Simulasi Tiket SUDAH DIGUNAKAN
            </button>
          </div>

          <!-- Result card container -->
          <div id="scanResult" class="scan-result-card"></div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script>
    function simulateScan(status) {
      const el = document.getElementById('scanResult');
      el.style.display = 'block';

      if (status === 'valid') {
        el.innerHTML = `
          <div style="display:flex; align-items:center; gap:8px; color:#10B981; font-weight:700; margin-bottom:8px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            CHECK-IN BERHASIL (TIKET VALID)
          </div>
          <div style="font-size:13px; color:var(--t-base); line-height:1.6;">
            <strong>Nama:</strong> Rian Hidayat<br>
            <strong>Kode Tiket:</strong> LG-BKT-2026-99214<br>
            <strong>Kategori:</strong> VIP Glow Run 5K<br>
            <strong>Waktu Masuk:</strong> ${new Date().toLocaleTimeString()} WIB<br>
            <strong>Status:</strong> <span style="color:#10B981; font-weight:700;">Check-in Tercatat</span>
          </div>
        `;
      } else {
        el.innerHTML = `
          <div style="display:flex; align-items:center; gap:8px; color:var(--danger); font-weight:700; margin-bottom:8px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            CHECK-IN DITOLAK: TIKET SUDAH DIPAKAI!
          </div>
          <div style="font-size:13px; color:var(--t-base); line-height:1.6;">
            <strong>Peringatan Keamanan:</strong> QR Code ini telah digunakan check-in pada pukul <strong>18:32 WIB</strong> di Gate 1.<br>
            Tiket tidak dapat digunakan dua kali!
          </div>
        `;
      }
    }
  </script>
</body>
</html>
