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
  <title>Data Pesanan & Pembeli · Light And Glow Bukittinggi</title>
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
<body data-active="pesanan" data-crumbs="Transaksi | Data Pesanan & Pembeli">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Transaksi</span>
            <h1 class="hero-title">Data Pesanan & <span class="accent">Pembeli Tiket</span></h1>
            <p class="hero-sub">Kelola seluruh riwayat transaksi, informasi data diri pemesan (email, telepon, identitas KTP/SIM), status e-tiket, serta unduh rekap laporan transaksi.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--ghost" onclick="exportData('csv')">
              <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              CSV
            </button>
            <button class="btn btn--primary" onclick="exportData('excel')">
              <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
              Excel
            </button>
          </div>
        </section>

        <!-- KPI Grid -->
        <section class="kpi-grid" style="margin-bottom: 24px;">
          <article class="kpi-card c-primary">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon primary"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg></div>
                <div class="kpi-label">Total Pesanan</div>
              </div>
              <span class="kpi-pill up">+24%</span>
            </div>
            <div class="kpi-value">163</div>
            <div class="kpi-compare">Seluruh transaksi terdata</div>
          </article>

          <article class="kpi-card c-success">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon success"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                <div class="kpi-label">Tiket Terbit (Aktif)</div>
              </div>
              <span class="kpi-pill up">158 Tiket</span>
            </div>
            <div class="kpi-value">Rp 28.450.000</div>
            <div class="kpi-compare">Total dana telah masuk</div>
          </article>

          <article class="kpi-card c-danger">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon danger"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
                <div class="kpi-label">Menunggu Verifikasi</div>
              </div>
              <span class="kpi-pill down">3 Antrean</span>
            </div>
            <div class="kpi-value">3</div>
            <div class="kpi-compare">Perlu tindakan di menu Verifikasi</div>
          </article>
        </section>

        <!-- Table Pesanan -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Transaksi</span>
              <h2 class="card-title">Data Pesanan & Status QR Code Tiket</h2>
            </div>
            <div style="display:flex; gap:10px;">
              <input type="text" id="orderSearch" placeholder="Cari nama, No. Order, atau email..." class="cms-input" style="padding:6px 12px; border:1px solid var(--border); border-radius:6px; background:var(--bg-body); font-size:13px;" onkeyup="filterOrders()">
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Data Pembeli</th>
                <th>Jenis Tiket</th>
                <th>Jumlah / Nominal</th>
                <th>Metode Bayar</th>
                <th>Status Pembayaran</th>
                <th>QR Code E-Tiket</th>
                <th style="text-align:right;">Aksi</th>
              </tr>
            </thead>
            <tbody id="orderTableBody">
              <tr>
                <td><strong>#LG-88421</strong><br><small style="color:var(--t-muted);">15 Apr 2026 14:10</small></td>
                <td>
                  <strong>Rian Hidayat</strong><br>
                  <small style="color:var(--t-muted);">rian.h@gmail.com · 081267891234</small>
                </td>
                <td>VIP Glow Run</td>
                <td><strong>1 Tiket</strong><br><span style="color:var(--primary);">Rp 275.000</span></td>
                <td>QRIS BCA</td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td><span style="color:var(--t-muted); font-size:12px;">Menunggu verifikasi</span></td>
                <td style="text-align:right;">
                  <a href="{{ route('admin.verifikasi') }}" class="btn btn--primary" style="padding:4px 8px; font-size:12px;">Verifikasi</a>
                </td>
              </tr>

              <tr>
                <td><strong>#LG-88415</strong><br><small style="color:var(--t-muted);">15 Apr 2026 11:05</small></td>
                <td>
                  <strong>Siti Aisyah</strong><br>
                  <small style="color:var(--t-muted);">siti.aisyah@yahoo.com · 082199887766</small>
                </td>
                <td>Reguler - 5K Night Run</td>
                <td><strong>2 Tiket</strong><br><span style="color:var(--primary);">Rp 300.000</span></td>
                <td>Transfer Mandiri</td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">Pembayaran Disetujui</span></td>
                <td><button class="btn btn--ghost" style="padding:3px 8px; font-size:11px;" onclick="showDigitalTicket('#LG-88415', 'Siti Aisyah', 'LG-BKT-2026-77821')">Lihat QR 🎫</button></td>
                <td style="text-align:right;">
                  <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px;" onclick="resendTicket('#LG-88415', 'siti.aisyah@yahoo.com')">Kirim Ulang</button>
                </td>
              </tr>

              <tr>
                <td><strong>#LG-88410</strong><br><small style="color:var(--t-muted);">14 Apr 2026 20:30</small></td>
                <td>
                  <strong>Doni Pratama</strong><br>
                  <small style="color:var(--t-muted);">doni.p@gmail.com · 085211223344</small>
                </td>
                <td>Early Bird - Festival Pass</td>
                <td><strong>1 Tiket</strong><br><span style="color:var(--primary);">Rp 99.000</span></td>
                <td>QRIS GoPay</td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">Pembayaran Disetujui</span></td>
                <td><button class="btn btn--ghost" style="padding:3px 8px; font-size:11px;" onclick="showDigitalTicket('#LG-88410', 'Doni Pratama', 'LG-BKT-2026-66312')">Lihat QR 🎫</button></td>
                <td style="text-align:right;">
                  <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px;" onclick="resendTicket('#LG-88410', 'doni.p@gmail.com')">Kirim Ulang</button>
                </td>
              </tr>

              <tr>
                <td><strong>#LG-88402</strong><br><small style="color:var(--t-muted);">14 Apr 2026 15:45</small></td>
                <td>
                  <strong>Ahmad Fauzan</strong><br>
                  <small style="color:var(--t-muted);">fauzan@gmail.com · 081399001122</small>
                </td>
                <td>Squad Bundle (4 Pax)</td>
                <td><strong>4 Tiket</strong><br><span style="color:var(--primary);">Rp 500.000</span></td>
                <td>Transfer BCA</td>
                <td><span class="tag t-danger" style="background:rgba(235,19,85,0.2); color:#EB1355; padding:3px 8px; border-radius:4px; font-weight:700;">Pembayaran Ditolak</span></td>
                <td><span style="color:var(--danger); font-size:12px;">Dibatalkan (Bukti tidak sesuai)</span></td>
                <td style="text-align:right;">
                  <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px; color:var(--danger);" onclick="viewRejectReason('Bukti transfer tidak sesuai dengan nominal total pemesanan tiket.')">Alasan</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function showDigitalTicket(orderId, name, qrToken) {
      Swal.fire({
        title: `Tiket Digital Resmi`,
        html: `
          <div style="text-align:center; padding:10px;">
            <div style="background:#0F172A; color:#fff; padding:16px; border-radius:12px; margin-bottom:14px; text-align:left;">
              <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:1px;">Light And Glow Bukittinggi 2026</div>
              <div style="font-size:18px; font-weight:800; color:#F8FAFC; margin-top:4px;">${name}</div>
              <div style="font-size:12px; color:#38BDF8; margin-top:2px;">Pesanan: ${orderId} · 25 April 2026 (Jam Gadang)</div>
            </div>
            <div style="background:#fff; padding:16px; border-radius:12px; border:2px dashed #CBD5E1; display:inline-block; margin-bottom:12px;">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${qrToken}" alt="QR Tiket" style="width:160px; height:160px;">
            </div>
            <div style="font-size:12px; font-family:monospace; color:#64748B; font-weight:700;">TOKEN: ${qrToken}</div>
            <p style="font-size:12px; color:#64748B; margin-top:8px;">Tunjukkan QR Code ini pada kamera scanner petugas di gate masuk.</p>
          </div>
        `,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Tutup'
      });
    }

    function resendTicket(orderId, email) {
      Swal.fire({
        title: 'Kirim Ulang E-Tiket?',
        text: `Kirim salinan tiket digital ber-QR Code ke email ${email}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        confirmButtonText: 'Kirim Sekarang',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            icon: 'success',
            title: 'E-Tiket Terkirim!',
            text: `Tiket digital untuk pesanan ${orderId} berhasil dikirim ke ${email}.`,
            confirmButtonColor: '#10B981'
          });
        }
      });
    }

    function viewRejectReason(reason) {
      Swal.fire({
        icon: 'warning',
        title: 'Alasan Penolakan Pembayaran',
        text: reason,
        confirmButtonColor: '#EB1355'
      });
    }

    function exportData(type) {
      Swal.fire({
        icon: 'success',
        title: `Laporan Siap Diunduh`,
        text: `Data transaksi pesanan tiket Light And Glow Bukittinggi berhasil diexport ke format .${type.toUpperCase()}.`,
        confirmButtonColor: '#EB1355'
      });
    }

    function filterOrders() {
      const q = document.getElementById('orderSearch').value.toLowerCase();
      const rows = document.querySelectorAll('#orderTableBody tr');
      rows.forEach(r => {
        const text = r.textContent.toLowerCase();
        r.style.display = text.includes(q) ? '' : 'none';
      });
    }
  </script>
</body>
</html>
