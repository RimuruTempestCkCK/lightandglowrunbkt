<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
  <title>Scanner QR Code Check-in · Light And Glow Bukittinggi</title>
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
      max-width: 580px;
      width: 100%;
      margin: 0 auto;
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 16px;
      padding: 20px;
      text-align: center;
      box-shadow: var(--shadow-card);
      box-sizing: border-box;
    }
    .viewfinder {
      width: 100%;
      height: 240px;
      background: #0B1120;
      border-radius: 14px;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      overflow: hidden;
      margin-bottom: 16px;
      border: 1px solid var(--border);
    }
    .scan-laser {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: #EB1355;
      box-shadow: 0 0 14px #EB1355;
      animation: scanAnim 2.5s infinite alternate ease-in-out;
    }
    @keyframes scanAnim {
      0% { top: 5%; }
      100% { top: 95%; }
    }
    .scan-reticle {
      width: 150px;
      height: 150px;
      border: 2px dashed rgba(255,255,255,0.65);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
    }
    .scan-result-card {
      background: var(--bg-body);
      border-radius: 12px;
      padding: 16px;
      margin-top: 16px;
      display: none;
      text-align: left;
      border: 1px solid var(--border);
      word-break: break-word;
    }
    @media (max-width: 480px) {
      .scanner-box {
        padding: 14px;
        border-radius: 12px;
      }
      .viewfinder {
        height: 210px;
      }
      .scan-reticle {
        width: 130px;
        height: 130px;
      }
      .scan-controls-row {
        flex-direction: column;
        width: 100%;
      }
      .scan-controls-row button,
      .scan-controls-row input {
        width: 100% !important;
      }
    }
  </style>
</head>
<body data-active="scanner" data-crumbs="Petugas | Scanner QR Code Check-in Gate">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow" id="heroDate">Check-in Gate Scanner</span>
            <h1 class="hero-title">Pemindaian <span class="accent">QR Code E-Tiket</span></h1>
            <p class="hero-sub">Pindai QR Code tiket peserta di gerbang masuk venue Light And Glow Bukittinggi. Sistem memverifikasi keabsahan tiket secara realtime dan mencatat log kehadiran.</p>
          </div>

        </section>

        <div class="scanner-box">
          <div id="cameraPreview" style="display:none; width:100%; border-radius:14px; overflow:hidden; margin-bottom:16px; border:2px solid var(--accent); position:relative;">
            <div id="interactive-reader" style="width:100%;"></div>
          </div>

          <div id="viewfinderPlaceholder" class="viewfinder">
            <div class="scan-laser"></div>
            <div class="scan-reticle">
              <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="1.5">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
              </svg>
            </div>
            <span style="font-size:12px; margin-top:12px; color:#94A3B8;">Arahkan kamera ke QR Code e-tiket peserta</span>
          </div>

          <div style="display:flex; justify-content:center; margin-bottom:16px;">
            <button id="btnToggleCamera" class="btn btn--primary" onclick="toggleCameraScanner()" style="font-size:13px; display:inline-flex; align-items:center; gap:6px; padding:10px 20px;">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
              <span>Nyalakan Kamera Scanner</span>
            </button>
          </div>

          <div style="margin-bottom:16px;">
            <div class="scan-controls-row" style="display:flex; gap:8px;">
              <input type="text" id="ticketCodeInput" class="form-control" placeholder="Ketik / scan kode tiket atau QR token..." style="padding:11px 14px; border-radius:8px; border:1px solid var(--border); background:var(--bg-body); color:inherit; flex:1;" onkeydown="if(event.key==='Enter') submitScanCode()" />
              <button class="btn btn--primary" onclick="submitScanCode()" style="white-space:nowrap; padding:11px 18px;">Validasi</button>
            </div>
            <div style="font-size:11px; color:var(--t-muted); margin-top:8px;">Mendukung input manual kode tiket maupun kamera scan langsung</div>
          </div>

          <!-- Result card container -->
          <div id="scanResult" class="scan-result-card"></div>
        </div>


      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/html5-qrcode"></script>
  <script>
    let html5QrScanner = null;
    let cameraIsRunning = false;

    async function toggleCameraScanner() {
      const btn = document.getElementById('btnToggleCamera');
      const camPreview = document.getElementById('cameraPreview');
      const placeholder = document.getElementById('viewfinderPlaceholder');

      if (!cameraIsRunning) {
        camPreview.style.display = 'block';
        placeholder.style.display = 'none';
        btn.classList.remove('btn--primary');
        btn.classList.add('btn--ghost');
        btn.innerHTML = `
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          <span>Matikan Kamera</span>
        `;

        try {
          html5QrScanner = new Html5Qrcode("interactive-reader");
          await html5QrScanner.start(
            { facingMode: "environment" },
            {
              fps: 10,
              qrbox: { width: 250, height: 250 }
            },
            (decodedText, decodedResult) => {
              // Successfully scanned QR Code
              console.log("Scanned QR:", decodedText);
              document.getElementById('ticketCodeInput').value = decodedText;
              submitScanCode();
              
              // Temporarily pause or let it continue with delay
              if (html5QrScanner) {
                html5QrScanner.pause();
                setTimeout(() => {
                  try { html5QrScanner.resume(); } catch(e){}
                }, 3000);
              }
            },
            (errorMessage) => {
              // Scan error or no QR in frame (normal)
            }
          );
          cameraIsRunning = true;
        } catch (err) {
          console.error("Camera error:", err);
          Swal.fire({
            icon: 'error',
            title: 'Kamera Tidak Dapat Diakses',
            text: 'Izin kamera ditolak atau perangkat kamera tidak ditemukan. Anda tetap dapat mengetik atau memindai menggunakan USB barcode scanner.'
          });
          stopCameraScanner();
        }
      } else {
        stopCameraScanner();
      }
    }

    function stopCameraScanner() {
      const btn = document.getElementById('btnToggleCamera');
      const camPreview = document.getElementById('cameraPreview');
      const placeholder = document.getElementById('viewfinderPlaceholder');

      if (html5QrScanner) {
        html5QrScanner.stop().then(() => {
          html5QrScanner.clear();
          html5QrScanner = null;
        }).catch(err => {
          console.warn("Stop error:", err);
        });
      }
      cameraIsRunning = false;
      camPreview.style.display = 'none';
      placeholder.style.display = 'flex';
      btn.classList.add('btn--primary');
      btn.classList.remove('btn--ghost');
      btn.innerHTML = `
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <span>Nyalakan Kamera Scanner</span>
      `;
    }

    async function submitScanCode() {
      const code = document.getElementById('ticketCodeInput').value.trim();
      if (!code) {
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan masukkan kode tiket atau token QR!' });
        return;
      }

      const el = document.getElementById('scanResult');
      el.style.display = 'block';
      el.innerHTML = '<div style="text-align:center; padding:10px; color:#64748B;">Memvalidasi tiket ke server database...</div>';

      try {
        const res = await fetch('/api/scanner/validate', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            qr_token: code,
            gate: 'Gate 1 (Utama Jam Gadang)',
            scanned_by: 'Petugas Gate 1'
          })
        });

        const data = await res.json();

        if (res.ok && data.status === 'valid') {
          el.innerHTML = `
            <div style="display:flex; align-items:center; gap:8px; color:#10B981; font-weight:700; margin-bottom:8px;">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              CHECK-IN BERHASIL (TIKET RESMI VALID)
            </div>
            <div style="font-size:13px; color:var(--t-base); line-height:1.6;">
              <strong>Nama Pemegang:</strong> ${data.data.attendee_name}<br>
              <strong>Kode Tiket:</strong> ${data.data.ticket_code}<br>
              <strong>Kategori:</strong> ${data.data.ticket_name}<br>
              <strong>No. Pesanan:</strong> ${data.data.order_number}<br>
              <strong>Gate:</strong> ${data.data.gate}<br>
              <strong>Status:</strong> <span style="color:#10B981; font-weight:700;">Check-in Berhasil Dicatat</span>
            </div>
          `;
          Swal.fire({
            icon: 'success',
            title: 'Check-in Berhasil! 🎉',
            html: `Tiket <b>${data.data.ticket_code}</b> atas nama <b>${data.data.attendee_name}</b> valid.<br><br><span style="color:#10B981; font-weight:700;">Silakan serahkan Jersey, Race Pack & LED Glow kit!</span>`,
            confirmButtonColor: '#10B981',
            confirmButtonText: 'Lanjut Scan Berikutnya'
          });
          document.getElementById('ticketCodeInput').value = '';
        } else if (data.status === 'rejected_used') {
          el.innerHTML = `
            <div style="display:flex; align-items:center; gap:8px; color:var(--danger); font-weight:700; margin-bottom:8px;">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
              CHECK-IN DITOLAK: TIKET SUDAH PERNAH DIGUNAKAN!
            </div>
            <div style="font-size:13px; color:var(--t-base); line-height:1.6;">
              <strong>Nama Pemegang:</strong> ${data.data.attendee_name}<br>
              <strong>Waktu Masuk Pertama:</strong> ${data.data.used_at} WIB<br>
              <span style="color:#EF4444; font-weight:700;">Peringatan Keamanan: Tiket ini tidak dapat dipakai masuk ulang!</span>
            </div>
          `;
          Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak!',
            html: `Tiket ini <b>sudah digunakan check-in</b> pada pukul <b>${data.data.used_at} WIB</b>.<br>Tidak boleh dipakai dua kali demi mencegah tiket ganda!`,
            confirmButtonColor: '#EB1355',
            confirmButtonText: 'Kembali'
          });
        } else {
          el.innerHTML = `
            <div style="color:var(--danger); font-weight:700;">
              ❌ TIKET TIDAK DITEMUKAN / TIDAK VALID
            </div>
            <div style="font-size:13px; color:#A1A1AA; margin-top:4px;">${data.message || 'Data tidak terdaftar di sistem acara.'}</div>
          `;
          Swal.fire({
            icon: 'error',
            title: 'Tiket Tidak Valid',
            text: data.message || 'QR Code atau kode tiket tidak ditemukan dalam database.',
            confirmButtonColor: '#EB1355'
          });
        }
      } catch (err) {
        el.innerHTML = '<div style="color:red;">Terjadi kesalahan saat memvalidasi tiket ke server.</div>';
      }
    }
  </script>
</body>
</html>
