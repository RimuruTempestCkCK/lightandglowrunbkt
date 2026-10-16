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
  <title>Data Pengguna / Pembeli · Light And Glow Bukittinggi</title>
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
    .table tbody tr {
      cursor: pointer;
      transition: background-color 0.15s ease;
    }
    .table tbody tr:hover {
      background-color: var(--bg-subtle, rgba(255,255,255,0.03));
    }
    .user-detail-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
    }
    /* Modal Styling */
    .adminator-modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      padding: 20px;
    }
    .adminator-modal {
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 16px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
      max-height: 90vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      animation: modalFadeIn 0.2s ease-out;
    }
    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.96); }
      to { opacity: 1; transform: scale(1); }
    }
    .adminator-modal-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 24px;
      border-bottom: 1px solid var(--border-soft);
    }
    .adminator-modal-title {
      font-size: 17px;
      font-weight: 700;
      color: var(--t-base);
      margin: 0;
    }
    .adminator-modal-close {
      background: transparent;
      border: none;
      color: var(--t-muted);
      cursor: pointer;
      padding: 4px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .adminator-modal-close:hover {
      color: var(--t-base);
      background: var(--bg-subtle);
    }
    .adminator-modal-body {
      padding: 24px;
      overflow-y: auto;
      flex: 1;
    }
    .adminator-modal-foot {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      padding: 16px 24px;
      border-top: 1px solid var(--border-soft);
      background: var(--bg-subtle, rgba(0,0,0,0.1));
    }
    .info-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      margin-bottom: 24px;
      background: var(--bg-subtle);
      border: 1px solid var(--border-soft);
      border-radius: 12px;
      padding: 16px;
    }
    .info-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .info-label {
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--t-muted);
    }
    .info-value {
      font-size: 13px;
      font-weight: 600;
      color: var(--t-base);
      word-break: break-all;
    }
    @media print {
      body * { visibility: hidden !important; }
      #printableUserList, #printableUserList * { visibility: visible !important; }
      #printableUserList {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
      }
      .no-print { display: none !important; }
    }
  </style>
</head>
<body data-active="users" data-crumbs="Master Data | Data User / Pembeli" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
  <div class="shell">
    <div data-shell-sidebar class="no-print"></div>
    <div class="main">
      <div data-shell-topbar class="no-print"></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero no-print" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Pengguna</span>
            <h1 class="hero-title">Data <span class="accent">User / Pembeli</span></h1>
            <p class="hero-sub">Daftar akun pembeli, detail data pribadi, riwayat order, dan tiket yang dimiliki.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--ghost" onclick="exportUsersCSV()">
              <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Ekspor CSV
            </button>
            <button class="btn btn--primary" onclick="printUsers()">
              <svg viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg>
              Cetak Data
            </button>
          </div>
        </section>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar no-print">
          <div class="filter-group">
            <label style="font-size:12px; font-weight:700; color:var(--t-muted);">Filter Aktivitas:</label>
            <select id="userStatusFilter" class="select" style="width: auto; padding: 7px 32px 7px 12px; font-size:13px;" onchange="applyUserFilter()">
              <option value="ALL">Semua Pengguna</option>
              <option value="HAS_ORDER">Pernah Membeli Tiket</option>
              <option value="NO_ORDER">Belum Membeli Tiket</option>
            </select>
          </div>

          <div class="filter-group" style="flex:1; max-width:400px;">
            <div class="input-icon" style="width:100%;">
              <span class="ico">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              </span>
              <input type="text" id="userSearchInput" class="input" placeholder="Cari nama, email, no. HP, atau NIK..." oninput="applyUserFilter()">
            </div>
          </div>
        </div>

        <!-- Table Card -->
        <div class="card" id="printableUserList" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Pengguna</span>
              <h2 class="card-title">Database Akun Pembeli</h2>
            </div>
            <div style="font-size:12px; color:var(--t-muted);" id="userCounterInfo">
              Menampilkan {{ count($buyers) }} pengguna
            </div>
          </div>

          <div class="table-scroll">
            <table class="table" style="width: 100%; min-width: 820px;" id="usersTable">
              <thead>
                <tr>
                  <th style="width:60px; white-space:nowrap;">ID</th>
                  <th style="white-space:nowrap;">Nama & Info Akun</th>
                  <th style="white-space:nowrap;">No. HP / WhatsApp</th>
                  <th style="white-space:nowrap;">NIK KTP</th>
                  <th style="text-align:center; white-space:nowrap;">Total Pesanan</th>
                  <th style="text-align:right; white-space:nowrap;">Total Transaksi</th>
                  <th style="text-align:right; white-space:nowrap;" class="no-print">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($buyers as $index => $b)
                  @php
                    $avatarGradients = ['ma-1', 'ma-2', 'ma-3', 'ma-4', 'ma-5', 'ma-6'];
                    $grad = $avatarGradients[$index % count($avatarGradients)];
                    $ordersData = $allOrders->get($b->id, collect());
                    $ticketsData = $allTickets->get($b->id, collect());
                  @endphp
                  <tr class="user-row"
                      data-id="{{ $b->id }}"
                      data-name="{{ $b->name }}"
                      data-email="{{ $b->email }}"
                      data-phone="{{ $b->phone }}"
                      data-nik="{{ $b->nik ?? '-' }}"
                      data-address="{{ $b->address ?? '-' }}"
                      data-joined="{{ $b->created_at ? \Carbon\Carbon::parse($b->created_at)->format('d M Y, H:i') : '-' }}"
                      data-total-orders="{{ $b->total_orders }}"
                      data-approved-orders="{{ $b->approved_orders }}"
                      data-total-spent="Rp {{ number_format($b->total_spent, 0, ',', '.') }}"
                      data-has-order="{{ $b->total_orders > 0 ? 'HAS_ORDER' : 'NO_ORDER' }}"
                      data-search="{{ strtolower($b->name . ' ' . $b->email . ' ' . $b->phone . ' ' . ($b->nik ?? '')) }}"
                      data-orders="{{ json_encode($ordersData) }}"
                      data-tickets="{{ json_encode($ticketsData) }}"
                      onclick="openUserDetailModal(this)">
                    <td class="cell-name">
                      <span class="data-cell-mono" style="font-weight:600; color:var(--primary);">#{{ $b->id }}</span>
                    </td>
                    <td>
                      <div class="data-cell-user">
                        <div class="av {{ $grad }}">{{ strtoupper(substr($b->name ?? 'U', 0, 1)) }}</div>
                        <div class="data-cell-user-meta">
                          <div class="data-cell-user-name" style="font-weight:600; color:var(--t-base);">{{ $b->name }}</div>
                          <div class="data-cell-user-email" style="font-size:12px; color:var(--t-muted);">{{ $b->email }}</div>
                        </div>
                      </div>
                    </td>
                    <td style="white-space:nowrap; font-size:13px;">
                      {{ $b->phone ?: '-' }}
                    </td>
                    <td style="white-space:nowrap; font-family:var(--font-mono); font-size:13px;">
                      {{ $b->nik ?: '-' }}
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                      @if($b->total_orders > 0)
                        <span class="badge success">{{ $b->total_orders }} Pesanan</span>
                      @else
                        <span class="badge" style="background:var(--bg-subtle); color:var(--t-muted);">0 Pesanan</span>
                      @endif
                    </td>
                    <td style="text-align:right; white-space:nowrap; font-weight:600; font-family:var(--font-mono); color:var(--primary);">
                      Rp {{ number_format($b->total_spent, 0, ',', '.') }}
                    </td>
                    <td style="text-align:right; white-space:nowrap;" class="no-print" onclick="event.stopPropagation()">
                      <button class="btn btn--ghost" style="padding: 6px 12px; font-size: 12px;" onclick="openUserDetailModal(this.closest('tr'))">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                        Detail
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" style="text-align:center; padding:32px; color:var(--t-muted);">
                      Belum ada data akun pembeli terdaftar.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div id="noUserMatchMessage" style="display:none; text-align:center; padding:36px; color:var(--t-muted); font-size:14px;">
            Tidak ditemukan data pengguna yang cocok dengan kriteria pencarian.
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Adminator Modal: Detail User / Pembeli -->
  <div id="adminatorUserModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeUserModal()">
    <div class="adminator-modal" style="max-width:760px; width:94%;">
      <div class="adminator-modal-head">
        <div style="display:flex; align-items:center; gap:12px;">
          <div id="modalUserAvatar" class="av ma-1" style="width:38px; height:38px; font-size:16px;">U</div>
          <div>
            <h3 class="adminator-modal-title" id="modalUserName">Nama Pengguna</h3>
            <span style="font-size:12px; color:var(--t-muted);" id="modalUserEmail">user@example.com</span>
          </div>
        </div>
        <button type="button" class="adminator-modal-close" onclick="closeUserModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>

      <div class="adminator-modal-body">
        <!-- Biodata Section -->
        <h4 style="font-size:13px; font-weight:700; margin:0 0 12px; text-transform:uppercase; letter-spacing:0.5px; color:var(--t-muted);">
          Informasi Profil & Kontak
        </h4>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">No. Telepon / WA</span>
            <span class="info-value" id="modalUserPhone">-</span>
          </div>
          <div class="info-item">
            <span class="info-label">NIK (KTP)</span>
            <span class="info-value" id="modalUserNik" style="font-family:var(--font-mono);">-</span>
          </div>
          <div class="info-item" style="grid-column: span 2;">
            <span class="info-label">Alamat Lengkap</span>
            <span class="info-value" id="modalUserAddress">-</span>
          </div>
          <div class="info-item">
            <span class="info-label">Tanggal Terdaftar</span>
            <span class="info-value" id="modalUserJoined">-</span>
          </div>
          <div class="info-item">
            <span class="info-label">Total Pengeluaran</span>
            <span class="info-value" id="modalUserSpent" style="color:var(--primary);">-</span>
          </div>
        </div>

        <!-- Orders Section -->
        <h4 style="font-size:13px; font-weight:700; margin:20px 0 12px; text-transform:uppercase; letter-spacing:0.5px; color:var(--t-muted); display:flex; justify-content:space-between; align-items:center;">
          <span>Riwayat Pesanan Tiket</span>
          <span id="modalOrdersCount" style="font-size:11px; padding:2px 8px; border-radius:10px; background:var(--bg-subtle);">0 pesanan</span>
        </h4>
        <div class="table-scroll" style="margin-bottom:24px;">
          <table class="table" style="width:100%; font-size:12px;">
            <thead>
              <tr>
                <th>No. Pesanan</th>
                <th>Kategori Tiket</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:right;">Total</th>
                <th style="text-align:right;">Status</th>
              </tr>
            </thead>
            <tbody id="modalOrdersTableBody">
              <!-- Populated via JS -->
            </tbody>
          </table>
        </div>

        <!-- Tickets Section -->
        <h4 style="font-size:13px; font-weight:700; margin:0 0 12px; text-transform:uppercase; letter-spacing:0.5px; color:var(--t-muted); display:flex; justify-content:space-between; align-items:center;">
          <span>E-Tiket & Kode QR Check-in</span>
          <span id="modalTicketsCount" style="font-size:11px; padding:2px 8px; border-radius:10px; background:var(--bg-subtle);">0 tiket</span>
        </h4>
        <div class="table-scroll">
          <table class="table" style="width:100%; font-size:12px;">
            <thead>
              <tr>
                <th>Kode Tiket</th>
                <th>Nama Pemegang</th>
                <th>Kategori</th>
                <th style="text-align:right;">Status Gate</th>
              </tr>
            </thead>
            <tbody id="modalTicketsTableBody">
              <!-- Populated via JS -->
            </tbody>
          </table>
        </div>
      </div>

      <div class="adminator-modal-foot">
        <button type="button" class="btn btn--ghost" onclick="printSingleUser()">
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg>
          Cetak Profil User Ini
        </button>
        <button type="button" class="btn btn--primary" onclick="closeUserModal()">Tutup</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let currentSelectedUser = null;

    function applyUserFilter() {
      const filter = document.getElementById('userStatusFilter').value;
      const query = document.getElementById('userSearchInput').value.toLowerCase().trim();
      const rows = document.querySelectorAll('.user-row');
      let visible = 0;

      rows.forEach(r => {
        const hasOrder = r.getAttribute('data-has-order');
        const search = r.getAttribute('data-search') || '';

        const matchFilter = (filter === 'ALL') || (hasOrder === filter);
        const matchQuery = !query || search.includes(query);

        if (matchFilter && matchQuery) {
          r.style.display = '';
          visible++;
        } else {
          r.style.display = 'none';
        }
      });

      const noMatch = document.getElementById('noUserMatchMessage');
      if (visible === 0 && rows.length > 0) {
        noMatch.style.display = 'block';
      } else {
        noMatch.style.display = 'none';
      }

      document.getElementById('userCounterInfo').textContent = `Menampilkan ${visible} pengguna`;
    }

    function openUserDetailModal(row) {
      if (!row) return;

      currentSelectedUser = {
        id: row.getAttribute('data-id'),
        name: row.getAttribute('data-name'),
        email: row.getAttribute('data-email'),
        phone: row.getAttribute('data-phone'),
        nik: row.getAttribute('data-nik'),
        address: row.getAttribute('data-address'),
        joined: row.getAttribute('data-joined'),
        totalOrders: row.getAttribute('data-total-orders'),
        approvedOrders: row.getAttribute('data-approved-orders'),
        totalSpent: row.getAttribute('data-total-spent'),
        orders: JSON.parse(row.getAttribute('data-orders') || '[]'),
        tickets: JSON.parse(row.getAttribute('data-tickets') || '[]')
      };

      document.getElementById('modalUserAvatar').textContent = (currentSelectedUser.name || 'U').charAt(0).toUpperCase();
      document.getElementById('modalUserName').textContent = currentSelectedUser.name;
      document.getElementById('modalUserEmail').textContent = currentSelectedUser.email;
      document.getElementById('modalUserPhone').textContent = currentSelectedUser.phone || '-';
      document.getElementById('modalUserNik').textContent = currentSelectedUser.nik || '-';
      document.getElementById('modalUserAddress').textContent = currentSelectedUser.address || '-';
      document.getElementById('modalUserJoined').textContent = currentSelectedUser.joined;
      document.getElementById('modalUserSpent').textContent = currentSelectedUser.totalSpent;

      // Populate Orders
      const ordersBody = document.getElementById('modalOrdersTableBody');
      ordersBody.innerHTML = '';
      document.getElementById('modalOrdersCount').textContent = `${currentSelectedUser.orders.length} pesanan`;

      if (currentSelectedUser.orders.length === 0) {
        ordersBody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding:16px; color:var(--t-muted);">Belum pernah melakukan pemesanan tiket.</td></tr>`;
      } else {
        currentSelectedUser.orders.forEach(o => {
          let badge = '';
          if (o.status === 'Pembayaran disetujui') {
            badge = '<span class="badge success dot">Disetujui</span>';
          } else if (o.status === 'Menunggu verifikasi') {
            badge = '<span class="badge warning dot">Menunggu</span>';
          } else {
            badge = '<span class="badge danger dot">Ditolak</span>';
          }

          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td style="font-family:var(--font-mono); font-weight:600; color:var(--primary);">${o.order_number}</td>
            <td>${o.ticket_name}</td>
            <td style="text-align:center; font-weight:600;">${o.quantity}</td>
            <td style="text-align:right; font-weight:600;">Rp ${Number(o.total_amount).toLocaleString('id-ID')}</td>
            <td style="text-align:right;">${badge}</td>
          `;
          ordersBody.appendChild(tr);
        });
      }

      // Populate Tickets
      const ticketsBody = document.getElementById('modalTicketsTableBody');
      ticketsBody.innerHTML = '';
      document.getElementById('modalTicketsCount').textContent = `${currentSelectedUser.tickets.length} tiket`;

      if (currentSelectedUser.tickets.length === 0) {
        ticketsBody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:16px; color:var(--t-muted);">Belum ada tiket digital yang aktif.</td></tr>`;
      } else {
        currentSelectedUser.tickets.forEach(t => {
          let statusBadge = '<span class="badge success dot">Aktif / Belum Dipakai</span>';
          if (t.status && t.status.toLowerCase().includes('sudah')) {
            statusBadge = '<span class="badge" style="background:var(--bg-subtle); color:var(--t-muted);">Sudah Digunakan</span>';
          }

          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td style="font-family:var(--font-mono); font-weight:600; color:var(--accent);">${t.ticket_code}</td>
            <td>${t.holder_name || currentSelectedUser.name}</td>
            <td>${t.ticket_name}</td>
            <td style="text-align:right;">${statusBadge}</td>
          `;
          ticketsBody.appendChild(tr);
        });
      }

      document.getElementById('adminatorUserModal').style.display = 'flex';
    }

    function closeUserModal() {
      document.getElementById('adminatorUserModal').style.display = 'none';
      currentSelectedUser = null;
    }

    function printUsers() {
      const rows = Array.from(document.querySelectorAll('.user-row')).filter(r => r.style.display !== 'none');
      if (rows.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data pengguna yang tampil untuk dicetak.' });
        return;
      }
      window.print();
    }

    function printSingleUser() {
      if (!currentSelectedUser) return;
      
      const printWindow = window.open('', '_blank');
      let ordersRows = '';
      currentSelectedUser.orders.forEach(o => {
        ordersRows += `<tr>
          <td style="padding:8px; border:1px solid #ddd;">${o.order_number}</td>
          <td style="padding:8px; border:1px solid #ddd;">${o.ticket_name}</td>
          <td style="padding:8px; border:1px solid #ddd; text-align:center;">${o.quantity}</td>
          <td style="padding:8px; border:1px solid #ddd; text-align:right;">Rp ${Number(o.total_amount).toLocaleString('id-ID')}</td>
          <td style="padding:8px; border:1px solid #ddd; text-align:center;">${o.status}</td>
        </tr>`;
      });

      let ticketsRows = '';
      currentSelectedUser.tickets.forEach(t => {
        ticketsRows += `<tr>
          <td style="padding:8px; border:1px solid #ddd;">${t.ticket_code}</td>
          <td style="padding:8px; border:1px solid #ddd;">${t.holder_name}</td>
          <td style="padding:8px; border:1px solid #ddd;">${t.ticket_name}</td>
          <td style="padding:8px; border:1px solid #ddd; text-align:center;">${t.status}</td>
        </tr>`;
      });

      printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
          <title>Profil User - ${currentSelectedUser.name}</title>
          <style>
            body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 24px; color: #111; }
            h2, h3 { margin: 0 0 8px; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 13px; }
            .info-table td { padding: 6px 12px; border: none; }
            .info-label { font-weight: bold; width: 180px; color: #555; }
            .header-card { border-bottom: 2px solid #222; padding-bottom: 12px; margin-bottom: 20px; }
          </style>
        </head>
        <body>
          <div class="header-card">
            <h2>LIGHT AND GLOW RUN BUKITTINGGI 2026</h2>
            <p style="margin:0; font-size:13px; color:#555;">Laporan Lengkap Profil & Transaksi Pengguna</p>
          </div>

          <table class="info-table" style="margin-bottom:24px;">
            <tr><td class="info-label">Nama Lengkap</td><td>: <strong>${currentSelectedUser.name}</strong></td></tr>
            <tr><td class="info-label">Email</td><td>: ${currentSelectedUser.email}</td></tr>
            <tr><td class="info-label">No. Telepon / WA</td><td>: ${currentSelectedUser.phone}</td></tr>
            <tr><td class="info-label">NIK (KTP)</td><td>: ${currentSelectedUser.nik}</td></tr>
            <tr><td class="info-label">Alamat</td><td>: ${currentSelectedUser.address}</td></tr>
            <tr><td class="info-label">Tanggal Terdaftar</td><td>: ${currentSelectedUser.joined}</td></tr>
            <tr><td class="info-label">Total Belanja</td><td>: <strong>${currentSelectedUser.totalSpent}</strong></td></tr>
          </table>

          <h3>Riwayat Pemesanan Tiket</h3>
          <table>
            <thead>
              <tr style="background:#f4f4f4;">
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">No. Pesanan</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Kategori Tiket</th>
                <th style="padding:8px; border:1px solid #ddd;">Qty</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:right;">Total Bayar</th>
                <th style="padding:8px; border:1px solid #ddd;">Status</th>
              </tr>
            </thead>
            <tbody>
              ${ordersRows || '<tr><td colspan="5" style="text-align:center; padding:12px;">Tidak ada pesanan.</td></tr>'}
            </tbody>
          </table>

          <h3>E-Tiket & Status Gate</h3>
          <table>
            <thead>
              <tr style="background:#f4f4f4;">
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Kode Tiket</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Nama Pemegang</th>
                <th style="padding:8px; border:1px solid #ddd; text-align:left;">Kategori</th>
                <th style="padding:8px; border:1px solid #ddd;">Status</th>
              </tr>
            </thead>
            <tbody>
              ${ticketsRows || '<tr><td colspan="4" style="text-align:center; padding:12px;">Tidak ada tiket.</td></tr>'}
            </tbody>
          </table>
        </body>
        </html>
      `);
      printWindow.document.close();
      printWindow.focus();
      setTimeout(() => {
        printWindow.print();
      }, 500);
    }

    function exportUsersCSV() {
      const rows = Array.from(document.querySelectorAll('.user-row')).filter(r => r.style.display !== 'none');
      if (rows.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data pengguna yang tampil untuk diekspor.' });
        return;
      }

      let csv = 'ID,Nama Pengguna,Email,No. HP,NIK,Alamat,Total Pesanan,Total Belanja\n';
      rows.forEach(r => {
        const id = r.getAttribute('data-id');
        const name = `"${r.getAttribute('data-name')}"`;
        const email = r.getAttribute('data-email');
        const phone = `'${r.getAttribute('data-phone')}`;
        const nik = `'${r.getAttribute('data-nik')}`;
        const address = `"${(r.getAttribute('data-address') || '').replace(/"/g, '""')}"`;
        const totalOrders = r.getAttribute('data-total-orders');
        const totalSpent = `"${r.getAttribute('data-total-spent')}"`;

        csv += `${id},${name},${email},${phone},${nik},${address},${totalOrders},${totalSpent}\n`;
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', `data_user_lightandglow_${new Date().toISOString().slice(0,10)}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  </script>
</body>
</html>
