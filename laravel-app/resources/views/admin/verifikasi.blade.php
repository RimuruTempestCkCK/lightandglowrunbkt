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
  <style>
    .filter-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 20px;
      align-items: center;
      justify-content: space-between;
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 12px;
      padding: 14px 18px;
    }
    .filter-group {
      display: flex;
      gap: 8px;
      align-items: center;
      flex-wrap: wrap;
    }
  </style>
</head>
<body data-active="verifikasi" data-crumbs="Transaksi | Verifikasi Pembayaran">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Transaksi</span>
            <h1 class="hero-title">Verifikasi <span class="accent">Pembayaran</span></h1>
            <p class="hero-sub">Periksa bukti transfer atau pembayaran QRIS dari pembeli tiket. Pesanan yang <strong>Menunggu Verifikasi</strong> selalu ditempatkan di paling atas antrean.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="location.reload()">
              <svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/></svg>
              Refresh Data
            </button>
          </div>
        </section>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar">
          <div class="filter-group">
            <label style="font-size:12px; font-weight:700; color:var(--t-muted);">Filter Status:</label>
            <select id="statusFilter" class="select" style="width: auto; padding: 7px 32px 7px 12px; font-size:13px;" onchange="applyFilter()">
              <option value="ALL">Semua Status</option>
              <option value="Menunggu verifikasi" selected>Menunggu Verifikasi (Prioritas)</option>
              <option value="Pembayaran disetujui">Pembayaran Disetujui</option>
              <option value="Pembayaran ditolak">Pembayaran Ditolak</option>
            </select>
          </div>

          <div class="filter-group" style="flex:1; max-width:380px;">
            <div class="input-icon" style="width:100%;">
              <span class="ico">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              </span>
              <input type="text" id="searchInput" class="input" placeholder="Cari no. pesanan, nama pembeli, hp..." oninput="applyFilter()">
            </div>
          </div>
        </div>

        <!-- Table Verifikasi -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Transaksi</span>
              <h2 class="card-title">Data Pembayaran Masuk</h2>
            </div>
            <div style="font-size:12px; color:var(--t-muted);" id="counterInfo">
              Menampilkan {{ count($orders) }} transaksi
            </div>
          </div>

          <table class="table" style="width: 100%;" id="ordersTable">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Nama Pembeli</th>
                <th>Kategori Tiket</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th style="text-align:right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $order)
              <tr id="row-{{ $order->id }}" class="order-row" data-status="{{ $order->status }}" data-search="{{ strtolower($order->order_number . ' ' . $order->buyer_name . ' ' . $order->buyer_email . ' ' . $order->buyer_phone . ' ' . $order->ticket_name) }}">
                <td><strong>#{{ $order->order_number }}</strong></td>
                <td>
                  <strong>{{ $order->buyer_name }}</strong><br>
                  <small style="color:var(--t-muted);">{{ $order->buyer_phone }}</small>
                </td>
                <td>{{ $order->ticket_name }}</td>
                <td><strong style="color:var(--primary);">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                <td>{{ $order->payment_method }}</td>
                <td>
                  @if($order->payment_proof)
                    <a href="#" onclick="viewProof('{{ addslashes($order->buyer_name) }}', '#{{ $order->order_number }}', '{{ asset(ltrim($order->payment_proof, '/')) }}'); return false;" style="color:var(--primary); font-weight:600; display:inline-flex; align-items:center; gap:4px;">
                      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      Lihat Bukti
                    </a>
                  @else
                    <span style="color:#94A3B8; font-size:12px;">Belum upload</span>
                  @endif
                </td>
                <td>
                  @if($order->status === 'Menunggu verifikasi')
                    <span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span>
                  @elseif($order->status === 'Pembayaran disetujui')
                    <span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">Disetujui</span>
                  @else
                    <span class="tag t-danger" style="background:rgba(239,68,68,0.2); color:#EF4444; padding:3px 8px; border-radius:4px; font-weight:700;">Ditolak</span>
                  @endif
                </td>
                <td style="text-align:right">
                  @if($order->status === 'Menunggu verifikasi')
                    <button class="btn btn--primary" style="padding:4px 10px; font-size:12px;" onclick="approvePayment('{{ $order->id }}', '{{ addslashes($order->buyer_name) }}', 'row-{{ $order->id }}')">Setujui</button>
                    <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="rejectPayment('{{ $order->id }}', '{{ addslashes($order->buyer_name) }}', 'row-{{ $order->id }}')">Tolak</button>
                  @elseif($order->status === 'Pembayaran disetujui')
                    <span style="color:#10B981; font-weight:600; font-size:12px;">✓ Tiket Terbit</span>
                  @else
                    <span style="color:#EF4444; font-weight:600; font-size:12px;">✕ Ditolak</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" style="text-align:center; padding:30px; color:#94A3B8;">
                  Belum ada transaksi pembayaran di sistem.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <div id="noMatchMessage" style="display:none; text-align:center; padding:30px; color:var(--t-muted);">
            Tidak ditemukan data yang cocok dengan kata kunci atau filter status yang dipilih.
          </div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function applyFilter() {
      const status = document.getElementById('statusFilter').value;
      const query = document.getElementById('searchInput').value.toLowerCase().trim();
      const rows = document.querySelectorAll('.order-row');
      let visibleCount = 0;

      rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const rowSearch = row.getAttribute('data-search') || '';

        const matchesStatus = (status === 'ALL') || (rowStatus === status);
        const matchesQuery = !query || rowSearch.includes(query);

        if (matchesStatus && matchesQuery) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      const noMatch = document.getElementById('noMatchMessage');
      if (visibleCount === 0 && rows.length > 0) {
        noMatch.style.display = 'block';
      } else {
        noMatch.style.display = 'none';
      }

      document.getElementById('counterInfo').textContent = `Menampilkan ${visibleCount} transaksi`;
    }

    // Default trigger filter on load
    document.addEventListener('DOMContentLoaded', () => {
      applyFilter();
    });

    function viewProof(name, orderId, imgUrl) {
      Swal.fire({
        title: `Bukti Bayar: ${name}`,
        text: `Pesanan ${orderId}`,
        imageUrl: imgUrl,
        imageWidth: 380,
        imageAlt: 'Bukti Transfer',
        confirmButtonColor: '#2563EB',
        confirmButtonText: 'Tutup'
      });
    }

    function approvePayment(orderId, name, rowId) {
      Swal.fire({
        title: `Setujui Pembayaran?`,
        html: `Apakah Anda yakin ingin memverifikasi pesanan atas nama <b>${name}</b>?<br><small style="color:gray;">Tiket digital & QR Code resmi akan langsung diterbitkan ke akun pembeli.</small>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return fetch(`/api/orders/${orderId}/verify`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          })
          .then(r => r.json())
          .then(res => {
            if (!res.success) throw new Error(res.message || 'Gagal memverifikasi');
            return res;
          })
          .catch(e => {
            Swal.showValidationMessage(`Error: ${e}`);
          });
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const row = document.getElementById(rowId);
          if (row) {
            row.setAttribute('data-status', 'Pembayaran disetujui');
            row.querySelector('.tag').className = 'tag t-success';
            row.querySelector('.tag').style.background = 'rgba(16,185,129,0.2)';
            row.querySelector('.tag').style.color = '#10B981';
            row.querySelector('.tag').textContent = 'Disetujui';
            row.querySelector('td:last-child').innerHTML = '<span style="color:#10B981; font-weight:600; font-size:12px;">✓ Tiket Terbit</span>';
          }
          applyFilter();
          Swal.fire({
            icon: 'success',
            title: 'Pembayaran Disetujui!',
            text: `Tiket digital dan QR Code untuk ${name} telah berhasil dibuat & aktif.`,
            confirmButtonColor: '#10B981'
          });
        }
      });
    }

    function rejectPayment(orderId, name, rowId) {
      Swal.fire({
        title: `Tolak Pembayaran`,
        text: `Masukkan alasan penolakan untuk pembeli ${name}:`,
        input: 'textarea',
        inputPlaceholder: 'Contoh: Nominal transfer tidak sesuai / bukti bayar tidak jelas / QRIS kedaluwarsa...',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Tolak Pembayaran',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: (reason) => {
          if (!reason || reason.trim() === '') {
            Swal.showValidationMessage('Alasan penolakan wajib diisi!');
            return false;
          }
          return fetch(`/api/orders/${orderId}/reject`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({ reason: reason })
          })
          .then(r => r.json())
          .then(res => {
            if (!res.success) throw new Error(res.message || 'Gagal menolak pesanan');
            return res;
          })
          .catch(e => {
            Swal.showValidationMessage(`Error: ${e}`);
          });
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const row = document.getElementById(rowId);
          if (row) {
            row.setAttribute('data-status', 'Pembayaran ditolak');
            row.querySelector('.tag').className = 'tag t-danger';
            row.querySelector('.tag').style.background = 'rgba(239,68,68,0.2)';
            row.querySelector('.tag').style.color = '#EF4444';
            row.querySelector('.tag').textContent = 'Ditolak';
            row.querySelector('td:last-child').innerHTML = '<span style="color:#EF4444; font-weight:600; font-size:12px;">✕ Ditolak</span>';
          }
          applyFilter();
          Swal.fire({
            icon: 'info',
            title: 'Pesanan Ditolak',
            text: `Pesanan telah ditolak dan pembeli telah diberi tahu alasan pembatalannya.`,
            confirmButtonColor: '#EF4444'
          });
        }
      });
    }
  </script>
</body>
</html>
