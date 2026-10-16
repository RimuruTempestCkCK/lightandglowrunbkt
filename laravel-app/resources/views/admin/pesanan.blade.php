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
    @media print {
      body * { visibility: hidden; }
      #printableArea, #printableArea * { visibility: visible; }
      #printableArea { position: absolute; left: 0; top: 0; width: 100%; }
      .no-print { display: none !important; }
    }
  </style>
</head>
<body data-active="pesanan" data-crumbs="Transaksi | Data Pesanan & Pembeli">
  <div class="shell">
    <div data-shell-sidebar class="no-print"></div>
    <div class="main">
      <div data-shell-topbar class="no-print"></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero no-print" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Transaksi</span>
            <h1 class="hero-title">Data Pesanan & <span class="accent">Pembeli Tiket</span></h1>
            <p class="hero-sub">Kelola seluruh riwayat transaksi, filter status pesanan, serta unduh rekap data sesuai hasil filter dalam format CSV dan cetak PDF.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--ghost" onclick="exportFilteredCSV()">
              <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Ekspor CSV
            </button>
            <button class="btn btn--primary" onclick="exportFilteredPDF()">
              <svg viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg>
              Cetak PDF
            </button>
          </div>
        </section>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar no-print">
          <div class="filter-group">
            <label style="font-size:12px; font-weight:700; color:var(--t-muted);">Status Pesanan:</label>
            <select id="statusFilter" class="select" style="width: auto; padding: 7px 32px 7px 12px; font-size:13px;" onchange="applyOrderFilter()">
              <option value="ALL">Semua Status</option>
              <option value="Pembayaran disetujui">Pembayaran Disetujui</option>
              <option value="Menunggu verifikasi">Menunggu Verifikasi</option>
              <option value="Pembayaran ditolak">Pembayaran Ditolak</option>
            </select>
          </div>

          <div class="filter-group" style="flex:1; max-width:380px;">
            <div class="input-icon" style="width:100%;">
              <span class="ico">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              </span>
              <input type="text" id="orderSearch" class="input" placeholder="Cari no. pesanan, nama pembeli, email..." oninput="applyOrderFilter()">
            </div>
          </div>
        </div>

        <!-- Table Pesanan -->
        <div class="card" id="printableArea" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Rekapitulasi Transaksi</span>
              <h2 class="card-title">Daftar Transaksi Pesanan Tiket (Database Real-time)</h2>
            </div>
            <div style="font-size:12px; color:var(--t-muted);" id="counterInfo">
              Menampilkan {{ count($orders) }} pesanan
            </div>
          </div>

          <table class="table" style="width: 100%;" id="ordersTable">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Data Pembeli</th>
                <th>Jenis Tiket</th>
                <th>Total Bayar</th>
                <th>Metode</th>
                <th>Status Pembayaran</th>
                <th style="text-align:right;" class="no-print">Aksi</th>
              </tr>
            </thead>
            <tbody id="orderTableBody">
              @forelse($orders as $o)
                <tr class="order-row" 
                    data-id="{{ $o->id }}"
                    data-order="{{ $o->order_number }}"
                    data-name="{{ $o->buyer_name }}"
                    data-email="{{ $o->buyer_email }}"
                    data-phone="{{ $o->buyer_phone }}"
                    data-ticket="{{ $o->ticket_name }}"
                    data-amount="{{ $o->total_amount }}"
                    data-method="{{ $o->payment_method }}"
                    data-status="{{ $o->status }}"
                    data-search="{{ strtolower($o->order_number . ' ' . $o->buyer_name . ' ' . $o->buyer_email . ' ' . $o->buyer_phone . ' ' . $o->ticket_name) }}">
                  <td>
                    <strong>#{{ $o->order_number }}</strong><br>
                    <small style="color:var(--t-muted);">{{ \Carbon\Carbon::parse($o->created_at)->format('d M Y H:i') }}</small>
                  </td>
                  <td>
                    <strong>{{ $o->buyer_name }}</strong><br>
                    <small style="color:var(--t-muted);">{{ $o->buyer_email }} · {{ $o->buyer_phone }}</small>
                  </td>
                  <td>{{ $o->ticket_name }}</td>
                  <td><strong style="color:var(--primary);">Rp {{ number_format($o->total_amount, 0, ',', '.') }}</strong></td>
                  <td>{{ $o->payment_method }}</td>
                  <td>
                    @if($o->status === 'Pembayaran disetujui')
                      <span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">Disetujui</span>
                    @elseif($o->status === 'Menunggu verifikasi')
                      <span class="tag t-warn" style="background:rgba(242,154,76,0.2); color:#F29A4C; padding:3px 8px; border-radius:4px; font-weight:700;">Menunggu Verifikasi</span>
                    @else
                      <span class="tag t-danger" style="background:rgba(239,68,68,0.2); color:#EF4444; padding:3px 8px; border-radius:4px; font-weight:700;">Ditolak</span>
                    @endif
                  </td>
                  <td style="text-align:right;" class="no-print">
                    @if($o->status === 'Menunggu verifikasi')
                      <a href="{{ route('admin.verifikasi') }}" class="btn btn--primary" style="padding:4px 8px; font-size:12px;">Verifikasi</a>
                    @elseif($o->status === 'Pembayaran disetujui')
                      <span style="color:#10B981; font-weight:600; font-size:12px;">✓ Lunas</span>
                    @else
                      <span style="color:var(--t-muted); font-size:12px;">Dibatalkan</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" style="text-align:center; padding:32px; color:var(--t-muted);">
                    Belum ada data pesanan di database MySQL.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div id="noMatchMessage" style="display:none; text-align:center; padding:30px; color:var(--t-muted);">
            Tidak ada pesanan yang sesuai dengan filter atau kata kunci pencarian.
          </div>
        </div>

      </main>
      <div data-shell-footer class="no-print"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function applyOrderFilter() {
      const status = document.getElementById('statusFilter').value;
      const query = document.getElementById('orderSearch').value.toLowerCase().trim();
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

      document.getElementById('counterInfo').textContent = `Menampilkan ${visibleCount} pesanan`;
    }

    // Export CSV data sesuai hasil filter
    function exportFilteredCSV() {
      const rows = Array.from(document.querySelectorAll('.order-row')).filter(r => r.style.display !== 'none');
      if (rows.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data pesanan yang tampil untuk diekspor.' });
        return;
      }

      let csv = 'No. Pesanan,Nama Pembeli,Email,Telepon,Jenis Tiket,Total Bayar,Metode Bayar,Status\n';

      rows.forEach(r => {
        const order = r.getAttribute('data-order');
        const name = `"${r.getAttribute('data-name')}"`;
        const email = r.getAttribute('data-email');
        const phone = `'${r.getAttribute('data-phone')}`;
        const ticket = `"${r.getAttribute('data-ticket')}"`;
        const amount = r.getAttribute('data-amount');
        const method = `"${r.getAttribute('data-method')}"`;
        const status = `"${r.getAttribute('data-status')}"`;

        csv += `${order},${name},${email},${phone},${ticket},${amount},${method},${status}\n`;
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', `pesanan_lightandglow_${new Date().toISOString().slice(0,10)}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    // Cetak PDF data sesuai hasil filter menggunakan window.print
    function exportFilteredPDF() {
      const rows = Array.from(document.querySelectorAll('.order-row')).filter(r => r.style.display !== 'none');
      if (rows.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data pesanan yang tampil untuk dicetak.' });
        return;
      }
      window.print();
    }
  </script>
</body>
</html>
