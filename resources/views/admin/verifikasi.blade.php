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
<body data-active="verifikasi" data-crumbs="Transaksi | Verifikasi Pembayaran" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Transaksi</span>
            <h1 class="hero-title">Verifikasi <span class="accent">Pembayaran</span></h1>
            <p class="hero-sub">Periksa dan validasi bukti transfer pembayaran tiket pembeli.</p>
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

          <div class="table-scroll">
            <table class="table" style="width: 100%; min-width: 850px;" id="ordersTable">
              <thead>
                <tr>
                  <th style="white-space: nowrap;">No. Pesanan</th>
                  <th style="white-space: nowrap;">Nama Pembeli</th>
                  <th style="white-space: nowrap;">Kategori Tiket</th>
                  <th style="white-space: nowrap;">Nominal</th>
                  <th style="white-space: nowrap;">Metode</th>
                  <th style="white-space: nowrap;">Bukti Bayar</th>
                  <th style="white-space: nowrap;">Status</th>
                  <th style="text-align:right; white-space: nowrap;">Aksi</th>
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
                      @php
                        $cleanProof = $order->payment_proof;
                        if (str_starts_with($cleanProof, 'http://127.0.0.1:8000/storage/')) {
                          $cleanProof = str_replace('http://127.0.0.1:8000/', '', $cleanProof);
                        } elseif (str_starts_with($cleanProof, 'http://localhost/storage/')) {
                          $cleanProof = str_replace('http://localhost/', '', $cleanProof);
                        }
                        $proofDisplayUrl = str_starts_with($cleanProof, 'http') ? $cleanProof : asset(ltrim($cleanProof, '/'));
                      @endphp
                      <a href="#" onclick="viewProof('{{ addslashes($order->buyer_name) }}', '#{{ $order->order_number }}', '{{ $proofDisplayUrl }}'); return false;" style="color:var(--primary); font-weight:600; display:inline-flex; align-items:center; gap:4px;">
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
          </div>
          <div id="noMatchMessage" style="display:none; text-align:center; padding:30px; color:var(--t-muted);">
            Tidak ditemukan data yang cocok dengan kata kunci atau filter status yang dipilih.
          </div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal 1: Lihat Bukti Pembayaran -->
  <div id="adminatorProofModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeProofModal()">
    <div class="adminator-modal" style="max-width:480px; width:92%;">
      <div class="adminator-modal-head">
        <h3 class="adminator-modal-title" id="proofModalTitle">Bukti Transfer Pembeli</h3>
        <button type="button" class="adminator-modal-close" onclick="closeProofModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body" style="text-align:center;">
        <div style="font-size:12px; color:var(--t-muted); margin-bottom:12px;" id="proofModalSubtitle">Pesanan</div>
        <div style="background:var(--bg-body); border:1px solid var(--border-soft); border-radius:10px; padding:12px; display:inline-block; max-width:100%;">
          <img id="proofModalImage" src="" alt="Bukti Transfer" style="max-width:100%; max-height:420px; border-radius:6px; object-fit:contain; display:block; margin:0 auto;">
        </div>
      </div>
      <div class="adminator-modal-foot">
        <a id="proofModalDownloadBtn" href="#" target="_blank" class="btn btn--ghost" style="margin-right:auto;">
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Buka Gambar Penuh
        </a>
        <button type="button" class="btn btn--primary" onclick="closeProofModal()">Tutup</button>
      </div>
    </div>
  </div>

  <!-- Adminator Modal 2: Konfirmasi Setujui Pembayaran -->
  <div id="adminatorApproveModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeApproveModal()">
    <div class="adminator-modal" style="max-width:460px; width:92%;">
      <div class="adminator-modal-head">
        <h3 class="adminator-modal-title" style="color:#10B981; display:flex; align-items:center; gap:8px;">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          Setujui Pembayaran
        </h3>
        <button type="button" class="adminator-modal-close" onclick="closeApproveModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <p style="margin:0 0 10px; font-size:14px; color:var(--t-base);">
          Apakah Anda yakin ingin memverifikasi pesanan atas nama <strong id="approveBuyerName"></strong>?
        </p>
        <div style="background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.25); border-radius:8px; padding:12px; font-size:12px; color:var(--t-base); line-height:1.5;">
          ✓ Tiket digital resmi akan segera aktif dan dapat diakses pembeli.<br>
          ✓ Kode QR Check-in gate akan otomatis diterbitkan.
        </div>
      </div>
      <div class="adminator-modal-foot">
        <button type="button" class="btn btn--ghost" onclick="closeApproveModal()">Batal</button>
        <button type="button" class="btn" style="background:#10B981; color:#fff;" id="btnConfirmApprove" onclick="executeApprovePayment()">
          Ya, Setujui Pembayaran
        </button>
      </div>
    </div>
  </div>

  <!-- Adminator Modal 3: Tolak Pembayaran -->
  <div id="adminatorRejectModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeRejectModal()">
    <div class="adminator-modal" style="max-width:480px; width:92%;">
      <div class="adminator-modal-head">
        <h3 class="adminator-modal-title" style="color:var(--danger); display:flex; align-items:center; gap:8px;">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          Tolak Pembayaran
        </h3>
        <button type="button" class="adminator-modal-close" onclick="closeRejectModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <p style="margin:0 0 10px; font-size:14px; color:var(--t-base);">
          Masukkan alasan penolakan pesanan untuk pembeli <strong id="rejectBuyerName"></strong>:
        </p>
        <div class="field">
          <label class="field-label">Alasan Penolakan <span class="req">*</span></label>
          <textarea id="rejectReasonInput" class="input" rows="4" style="resize:vertical; font-family:inherit; font-size:13px; line-height:1.5;" placeholder="Contoh: Nominal transfer tidak sesuai / bukti bayar tidak jelas / QRIS kedaluwarsa..."></textarea>
          <div id="rejectErrorText" style="color:var(--danger); font-size:11px; margin-top:4px; display:none;">Alasan penolakan wajib diisi!</div>
        </div>
      </div>
      <div class="adminator-modal-foot">
        <button type="button" class="btn btn--ghost" onclick="closeRejectModal()">Batal</button>
        <button type="button" class="btn" style="background:#EF4444; color:#fff;" id="btnConfirmReject" onclick="executeRejectPayment()">
          Tolak Pembayaran
        </button>
      </div>
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

    // 1. LIHAT BUKTI (Adminator Modal)
    function viewProof(name, orderId, imgUrl) {
      document.getElementById('proofModalTitle').textContent = `Bukti Transfer: ${name}`;
      document.getElementById('proofModalSubtitle').textContent = `Pesanan: ${orderId}`;
      const img = document.getElementById('proofModalImage');
      img.src = imgUrl;
      document.getElementById('proofModalDownloadBtn').href = imgUrl;
      document.getElementById('adminatorProofModal').style.display = 'flex';
    }

    function closeProofModal() {
      document.getElementById('adminatorProofModal').style.display = 'none';
    }

    // 2. SETUJUI PEMBAYARAN (Adminator Modal)
    let currentApproveOrderId = null;
    let currentApproveName = null;
    let currentApproveRowId = null;

    function approvePayment(orderId, name, rowId) {
      currentApproveOrderId = orderId;
      currentApproveName = name;
      currentApproveRowId = rowId;
      document.getElementById('approveBuyerName').textContent = name;
      document.getElementById('adminatorApproveModal').style.display = 'flex';
    }

    function closeApproveModal() {
      currentApproveOrderId = null;
      currentApproveName = null;
      currentApproveRowId = null;
      document.getElementById('adminatorApproveModal').style.display = 'none';
    }

    async function executeApprovePayment() {
      if (!currentApproveOrderId) return;
      const btn = document.getElementById('btnConfirmApprove');
      btn.disabled = true;
      btn.textContent = 'Memproses...';

      try {
        const response = await fetch(`/api/orders/${currentApproveOrderId}/verify`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        });
        const res = await response.json();

        if (!res.success) {
          throw new Error(res.message || 'Gagal memverifikasi');
        }

        const row = document.getElementById(currentApproveRowId);
        if (row) {
          row.setAttribute('data-status', 'Pembayaran disetujui');
          row.querySelector('.tag').className = 'tag t-success';
          row.querySelector('.tag').style.background = 'rgba(16,185,129,0.2)';
          row.querySelector('.tag').style.color = '#10B981';
          row.querySelector('.tag').textContent = 'Disetujui';
          row.querySelector('td:last-child').innerHTML = '<span style="color:#10B981; font-weight:600; font-size:12px;">✓ Tiket Terbit</span>';
        }
        applyFilter();
        closeApproveModal();

        // Notifikasi hasil sukses dengan SweetAlert
        Swal.fire({
          icon: 'success',
          title: 'Pembayaran Disetujui!',
          text: `Tiket digital dan QR Code untuk ${currentApproveName || 'pembeli'} telah berhasil dibuat & aktif.`,
          confirmButtonColor: '#10B981'
        });
      } catch (e) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: `Terjadi kendala: ${e.message || e}`,
          confirmButtonColor: '#EF4444'
        });
      } finally {
        btn.disabled = false;
        btn.textContent = 'Ya, Setujui Pembayaran';
      }
    }

    // 3. TOLAK PEMBAYARAN (Adminator Modal)
    let currentRejectOrderId = null;
    let currentRejectName = null;
    let currentRejectRowId = null;

    function rejectPayment(orderId, name, rowId) {
      currentRejectOrderId = orderId;
      currentRejectName = name;
      currentRejectRowId = rowId;
      document.getElementById('rejectBuyerName').textContent = name;
      document.getElementById('rejectReasonInput').value = '';
      document.getElementById('rejectErrorText').style.display = 'none';
      document.getElementById('adminatorRejectModal').style.display = 'flex';
    }

    function closeRejectModal() {
      currentRejectOrderId = null;
      currentRejectName = null;
      currentRejectRowId = null;
      document.getElementById('adminatorRejectModal').style.display = 'none';
    }

    async function executeRejectPayment() {
      const reasonInput = document.getElementById('rejectReasonInput');
      const reason = reasonInput.value ? reasonInput.value.trim() : '';
      const errorText = document.getElementById('rejectErrorText');

      if (!reason) {
        errorText.style.display = 'block';
        reasonInput.focus();
        return;
      }
      errorText.style.display = 'none';

      const btn = document.getElementById('btnConfirmReject');
      btn.disabled = true;
      btn.textContent = 'Memproses...';

      try {
        const response = await fetch(`/api/orders/${currentRejectOrderId}/reject`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ reason: reason })
        });
        const res = await response.json();

        if (!res.success) {
          throw new Error(res.message || 'Gagal menolak pesanan');
        }

        const row = document.getElementById(currentRejectRowId);
        if (row) {
          row.setAttribute('data-status', 'Pembayaran ditolak');
          row.querySelector('.tag').className = 'tag t-danger';
          row.querySelector('.tag').style.background = 'rgba(239,68,68,0.2)';
          row.querySelector('.tag').style.color = '#EF4444';
          row.querySelector('.tag').textContent = 'Ditolak';
          row.querySelector('td:last-child').innerHTML = '<span style="color:#EF4444; font-weight:600; font-size:12px;">✕ Ditolak</span>';
        }
        applyFilter();
        closeRejectModal();

        // Notifikasi hasil penolakan dengan SweetAlert
        Swal.fire({
          icon: 'info',
          title: 'Pesanan Ditolak',
          text: `Pesanan telah ditolak dan pembeli telah diberi tahu alasan pembatalannya.`,
          confirmButtonColor: '#EF4444'
        });
      } catch (e) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: `Terjadi kendala: ${e.message || e}`,
          confirmButtonColor: '#EF4444'
        });
      } finally {
        btn.disabled = false;
        btn.textContent = 'Tolak Pembayaran';
      }
    }

    // Keyboard Escape to close modals
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeProofModal();
        closeApproveModal();
        closeRejectModal();
      }
    });
  </script>
</body>
</html>
