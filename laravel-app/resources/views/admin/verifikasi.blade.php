<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>Verifikasi Pembayaran · Light And Glow Bukittinggi</title>
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
<body data-active="verifikasi" data-crumbs="Manajemen Tiket | Verifikasi Pembayaran">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Transaksi</span>
            <h1 class="hero-title">Verifikasi <span class="accent">Pembayaran</span></h1>
            <p class="hero-sub">Periksa bukti transfer atau pembayaran QRIS dari pembeli tiket, setujui untuk menerbitkan tiket digital & QR Code unik, atau tolak disertai alasan.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="alert('Sinkronisasi pembayaran QRIS otomatis aktif')">
              <svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/></svg>
              Refresh Data
            </button>
          </div>
        </section>

        <!-- Table Verifikasi -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Antrean</span>
              <h2 class="card-title">Bukti Transfer & QRIS Perlu Diverifikasi</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Nama Pembeli</th>
                <th>Jenis Tiket</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th style="text-align:right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>#LG-88421</strong></td>
                <td>Rian Hidayat</td>
                <td>Presale - VIP Glow Run</td>
                <td><strong>Rp 275.000</strong></td>
                <td>QRIS BCA</td>
                <td><a href="#" onclick="alert('Menampilkan foto bukti transfer/QRIS dari Rian Hidayat'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="alert('Pembayaran #LG-88421 Disetujui! Tiket digital & QR Code unik telah diaktifkan untuk pembeli.')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="prompt('Masukkan alasan penolakan pembayaran:')">Tolak</button>
                </td>
              </tr>

              <tr>
                <td><strong>#LG-88420</strong></td>
                <td>Nadia Putri</td>
                <td>Reguler - 5K Night Run</td>
                <td><strong>Rp 150.000</strong></td>
                <td>Transfer Mandiri</td>
                <td><a href="#" onclick="alert('Menampilkan foto bukti transfer dari Nadia Putri'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="alert('Pembayaran #LG-88420 Disetujui! Tiket digital & QR Code unik telah diaktifkan untuk pembeli.')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="prompt('Masukkan alasan penolakan pembayaran:')">Tolak</button>
                </td>
              </tr>

              <tr>
                <td><strong>#LG-88419</strong></td>
                <td>Budi Setiawan</td>
                <td>Early Bird - Festival Pass</td>
                <td><strong>Rp 99.000</strong></td>
                <td>QRIS GoPay</td>
                <td><a href="#" onclick="alert('Menampilkan foto bukti transfer dari Budi Setiawan'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="alert('Pembayaran #LG-88419 Disetujui! Tiket digital & QR Code unik telah diaktifkan untuk pembeli.')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="prompt('Masukkan alasan penolakan pembayaran:')">Tolak</button>
                </td>
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
