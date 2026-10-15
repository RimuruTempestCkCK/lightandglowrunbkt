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
            <button class="btn btn--primary" onclick="refreshData()">
              <svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/></svg>
              Refresh
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
              <tr id="row-88421">
                <td><strong>#LG-88421</strong></td>
                <td>Rian Hidayat</td>
                <td>Presale - VIP Glow Run</td>
                <td><strong>Rp 275.000</strong></td>
                <td>QRIS BCA</td>
                <td><a href="#" onclick="viewProof('Rian Hidayat', '#LG-88421', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="approvePayment('#LG-88421', 'Rian Hidayat', 'row-88421')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="rejectPayment('#LG-88421', 'Rian Hidayat', 'row-88421')">Tolak</button>
                </td>
              </tr>

              <tr id="row-88420">
                <td><strong>#LG-88420</strong></td>
                <td>Nadia Putri</td>
                <td>Reguler - 5K Night Run</td>
                <td><strong>Rp 150.000</strong></td>
                <td>Transfer Mandiri</td>
                <td><a href="#" onclick="viewProof('Nadia Putri', '#LG-88420', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="approvePayment('#LG-88420', 'Nadia Putri', 'row-88420')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="rejectPayment('#LG-88420', 'Nadia Putri', 'row-88420')">Tolak</button>
                </td>
              </tr>

              <tr id="row-88419">
                <td><strong>#LG-88419</strong></td>
                <td>Budi Setiawan</td>
                <td>Early Bird - Festival Pass</td>
                <td><strong>Rp 99.000</strong></td>
                <td>QRIS GoPay</td>
                <td><a href="#" onclick="viewProof('Budi Setiawan', '#LG-88419', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60'); return false;" style="color:var(--primary); font-weight:600;">Lihat Bukti 🔍</a></td>
                <td><span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span></td>
                <td style="text-align:right">
                  <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="approvePayment('#LG-88419', 'Budi Setiawan', 'row-88419')">Setujui</button>
                  <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="rejectPayment('#LG-88419', 'Budi Setiawan', 'row-88419')">Tolak</button>
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
    function refreshData() {
      Swal.fire({
        title: 'Sinkronisasi...',
        text: 'Memeriksa mutasi rekening & transaksi QRIS otomatis.',
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then(() => {
        Swal.fire({
          icon: 'success',
          title: 'Data Terkini',
          text: 'Semua status antrean transaksi telah disinkronkan.',
          confirmButtonColor: '#EB1355'
        });
      });
    }

    function viewProof(name, orderId, imgUrl) {
      Swal.fire({
        title: `Bukti Bayar: ${name}`,
        text: `Pesanan ${orderId}`,
        imageUrl: imgUrl,
        imageWidth: 350,
        imageHeight: 250,
        imageAlt: 'Bukti Transfer',
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Tutup'
      });
    }

    function approvePayment(orderId, name, rowId) {
      Swal.fire({
        title: `Setujui Pembayaran?`,
        html: `Apakah Anda yakin ingin memverifikasi pesanan <b>${orderId}</b> atas nama <b>${name}</b>?<br><small style="color:gray;">Tiket digital & QR Code resmi akan langsung diterbitkan.</small>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          const row = document.getElementById(rowId);
          if (row) {
            row.style.opacity = '0.5';
            row.querySelector('.tag').className = 'tag t-success';
            row.querySelector('.tag').style.background = 'rgba(16,185,129,0.2)';
            row.querySelector('.tag').style.color = '#10B981';
            row.querySelector('.tag').textContent = 'Disetujui';
            row.querySelector('td:last-child').innerHTML = '<span style="color:#10B981; font-weight:600; font-size:12px;">✓ Selesai</span>';
          }
          Swal.fire({
            icon: 'success',
            title: 'Pembayaran Disetujui!',
            text: `Tiket digital dan QR Code untuk ${name} (${orderId}) telah aktif.`,
            confirmButtonColor: '#10B981'
          });
        }
      });
    }

    function rejectPayment(orderId, name, rowId) {
      Swal.fire({
        title: `Tolak Pembayaran ${orderId}`,
        text: `Masukkan alasan penolakan untuk dikirim ke ${name}:`,
        input: 'textarea',
        inputPlaceholder: 'Contoh: Nominal transfer kurang / bukti bayar tidak jelas / QRIS kedaluwarsa...',
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Tolak Pembayaran',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
          if (!value) {
            return 'Alasan penolakan wajib diisi!';
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const row = document.getElementById(rowId);
          if (row) {
            row.style.opacity = '0.5';
            row.querySelector('.tag').className = 'tag t-danger';
            row.querySelector('.tag').style.background = 'rgba(235,19,85,0.2)';
            row.querySelector('.tag').style.color = '#EB1355';
            row.querySelector('.tag').textContent = 'Ditolak';
            row.querySelector('td:last-child').innerHTML = '<span style="color:var(--danger); font-weight:600; font-size:12px;">✕ Dibatalkan</span>';
          }
          Swal.fire({
            icon: 'info',
            title: 'Pembayaran Ditolak',
            text: `Pesanan ${orderId} telah dibatalkan dengan alasan: "${result.value}".`,
            confirmButtonColor: '#EB1355'
          });
        }
      });
    }
  </script>
</body>
</html>
