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
  <title>Master Tiket & Benefit · Light And Glow Bukittinggi</title>
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
    .tiket-table-wrap {
      overflow-x: auto;
      background: var(--bg-card);
      border-radius: 12px;
      border: 1px solid var(--border-soft);
      padding: 20px;
    }
    .thumb-preview {
      width: 52px;
      height: 52px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid var(--border-soft);
    }
    .btn-action-group {
      display: flex;
      gap: 6px;
      justify-content: flex-end;
    }
    .benefit-tag-item {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: rgba(14, 165, 233, 0.12);
      color: #0284c7;
      border-radius: 4px;
      padding: 2px 7px;
      font-size: 11px;
      font-weight: 600;
      margin: 2px;
    }
    .alert-banner {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      font-weight: 500;
    }
    .alert-success {
      background: #ECFDF5;
      color: #065F46;
      border: 1px solid #A7F3D0;
    }
    .alert-danger {
      background: #FEF2F2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }
  </style>
</head>
<body data-active="tiket_direct" data-crumbs="Master Data | Master Tiket & Benefit" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Alerts Notification -->
        @if(session('success'))
          <div class="alert-banner alert-success">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert-banner alert-danger">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
          </div>
        @endif

        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Database MySQL Real-Time</span>
            <h1 class="hero-title">Kelola <span class="accent">Tiket & Benefit</span></h1>
            <p class="hero-sub">Kelola kategori tiket, harga, kuota, serta daftar benefit pamflet resmi yang langsung tersinkronisasi ke Halaman Detail & Preview Pembeli.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="openAddTicketModal()">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Tiket Baru
            </button>
          </div>
        </section>

        <!-- Table Master Tiket -->
        <div class="tiket-table-wrap">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Data Database Terkini</span>
              <h2 class="card-title">Katalog Tiket & Paket Peserta Light And Glow</h2>
            </div>
          </div>

          <table class="table" style="width: 100%; min-width: 850px;">
            <thead>
              <tr>
                <th style="width: 60px; white-space:nowrap;">Foto</th>
                <th style="white-space:nowrap;">Nama Tiket</th>
                <th style="white-space:nowrap;">Kategori</th>
                <th style="white-space:nowrap;">Harga</th>
                <th style="white-space:nowrap;">Kuota / Sisa</th>
                <th style="white-space:nowrap;">Benefit Peserta (Pamflet)</th>
                <th style="text-align: right; width: 180px; white-space:nowrap;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tickets as $t)
                @php
                  $benefitsArr = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $t->benefits ?? '')));
                @endphp
                <tr>
                  <td>
                    <img src="{{ $t->image ?: 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60' }}" class="thumb-preview" alt="{{ $t->name }}">
                  </td>
                  <td>
                    <strong style="font-size:14px; display:block;">{{ $t->name }}</strong>
                    <span style="font-size:11px; color:var(--text-sub);">ID Tiket: #{{ $t->id }}</span>
                  </td>
                  <td>
                    <span class="tag" style="background:rgba(235,19,85,0.12); color:var(--primary); font-weight:600; padding:3px 8px; border-radius:4px;">
                      {{ $t->category ?: 'Reguler' }}
                    </span>
                  </td>
                  <td>
                    <strong style="color:var(--primary); font-size:15px;">
                      Rp {{ number_format($t->price, 0, ',', '.') }}
                    </strong>
                  </td>
                  <td>
                    <div style="font-size:13px; font-weight:600;">
                      {{ $t->remaining_quota }} <span style="font-weight:400; color:var(--text-sub);">/ {{ $t->quota }}</span>
                    </div>
                    @if($t->remaining_quota <= 0)
                      <span style="display:inline-block; font-size:10px; font-weight:700; color:#EF4444; background:#FEE2E2; padding:1px 6px; border-radius:3px; margin-top:2px;">HABIS</span>
                    @endif
                  </td>
                  <td>
                    <div style="max-width: 280px; display:flex; flex-wrap:wrap;">
                      @if(count($benefitsArr) > 0)
                        @foreach($benefitsArr as $b)
                          <span class="benefit-tag-item">✓ {{ $b }}</span>
                        @endforeach
                      @else
                        <span style="color:var(--text-sub); font-size:12px; font-style:italic;">Belum ada benefit</span>
                      @endif
                    </div>
                  </td>
                  <td style="text-align: right;">
                    <div class="btn-action-group">
                      <button class="btn btn--ghost" style="padding:5px 9px; font-size:12px;" onclick='openEditTicketModal(@json($t))'>
                        Edit
                      </button>
                      <button class="btn btn--ghost" style="padding:5px 9px; font-size:12px; color:var(--danger);" onclick="confirmDeleteTicket({{ $t->id }}, '{{ addslashes($t->name) }}')">
                        Hapus
                      </button>
                    </div>
                    <!-- Form Delete Hidden -->
                    <form id="delete-form-{{ $t->id }}" action="{{ route('admin.tiket.delete', $t->id) }}" method="POST" style="display:none;">
                      @csrf
                      @method('DELETE')
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" style="text-align:center; padding:32px; color:var(--text-sub);">
                    Belum ada data tiket di database MySQL. Silakan klik tombol "Tambah Tiket Baru".
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Create / Edit) -->
  <div id="adminatorTicketModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeTicketAdminModal()">
    <div class="adminator-modal" style="max-width:580px; width:92%;">
      <form id="modalTicketForm" method="POST" action="{{ route('admin.tiket.store') }}">
        @csrf
        <div class="adminator-modal-head">
          <h3 id="adminModalTitle" class="adminator-modal-title">Tambah Tiket Baru</h3>
          <button type="button" class="adminator-modal-close" onclick="closeTicketAdminModal()" aria-label="Tutup">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:14px;">
            <div>
              <label class="field-label">Nama Tiket <span class="req">*</span></label>
              <input id="inputTicketName" name="name" class="input" placeholder="Contoh: Reguler atau VIP" required>
            </div>
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
              <div>
                <label class="field-label">Harga (Rp) <span class="req">*</span></label>
                <input id="inputTicketPrice" name="price" type="number" step="1000" class="input" placeholder="Contoh: 100000" required>
              </div>
              <div>
                <label class="field-label">Kategori / Tipe</label>
                <input id="inputTicketCategory" name="category" class="input" placeholder="Contoh: Reguler / VIP">
              </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
              <div>
                <label class="field-label">Total Kuota Tiket <span class="req">*</span></label>
                <input id="inputTicketQuota" name="quota" type="number" min="1" class="input" placeholder="Contoh: 500" required>
              </div>
              <div>
                <label class="field-label">URL / Path Foto Sampul</label>
                <input id="inputTicketImg" name="image" class="input" placeholder="https://images.unsplash.com/...">
              </div>
            </div>

            <div>
              <label class="field-label">
                Daftar Benefit Peserta <span class="req">*</span> 
                <span style="font-weight:400; color:var(--text-sub); font-size:12px;">(Tulis 1 benefit per baris)</span>
              </label>
              <textarea id="inputTicketBenefits" name="benefits" class="input" rows="5" style="resize:vertical; font-family:inherit; line-height:1.5;" placeholder="Contoh:&#10;Jersey Eksklusif&#10;Medali Finisher&#10;Stick Glow&#10;E-Sertifikat"></textarea>
              <small style="color:var(--text-sub); font-size:11px; display:block; margin-top:4px;">
                💡 Sesuai pamflet: Reguler dapat Jersey, Medali Finisher, E-Sertifikat. VIP dapat Goodie Bag, Jersey, Stick Glow, Kaca Mata Lampu, Barisan Paling Depan, Medali Finisher, E-Sertifikat.
              </small>
            </div>
          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeTicketAdminModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitModal">Simpan ke Database</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Adminator Modal Konfirmasi Hapus Tiket -->
  <div id="adminatorDeleteTicketModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeDeleteTicketModal()">
    <div class="adminator-modal" style="max-width:440px; width:92%;">
      <div class="adminator-modal-head">
        <h3 class="adminator-modal-title" style="color:var(--danger); display:flex; align-items:center; gap:8px;">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Konfirmasi Hapus Tiket
        </h3>
        <button type="button" class="adminator-modal-close" onclick="closeDeleteTicketModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <p style="margin:0 0 8px; font-size:14px; color:var(--t-base);">Apakah Anda yakin ingin menghapus tiket <strong id="deleteTicketNameLabel"></strong>?</p>
        <span style="font-size:12px; color:var(--t-muted); display:block; line-height:1.5;">Data kategori tiket ini akan dihapus permanen dari database sistem. Tindakan ini tidak dapat dibatalkan.</span>
      </div>
      <div class="adminator-modal-foot">
        <button type="button" class="btn btn--ghost" onclick="closeDeleteTicketModal()">Batal</button>
        <button type="button" class="btn" style="background:#EF4444; color:#fff;" id="btnConfirmDeleteTicket" onclick="executeDeleteTicket()">Ya, Hapus Tiket</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let activeDeleteTicketId = null;

    function openDeleteTicketModal(id, name) {
      activeDeleteTicketId = id;
      document.getElementById('deleteTicketNameLabel').textContent = '"' + name + '"';
      document.getElementById('adminatorDeleteTicketModal').style.display = 'flex';
    }

    function closeDeleteTicketModal() {
      activeDeleteTicketId = null;
      document.getElementById('adminatorDeleteTicketModal').style.display = 'none';
    }

    function executeDeleteTicket() {
      if (activeDeleteTicketId) {
        const form = document.getElementById('delete-form-' + activeDeleteTicketId);
        if (form) {
          form.submit();
        }
      }
    }

    function closeTicketAdminModal() {
      document.getElementById('adminatorTicketModal').style.display = 'none';
    }

    function openAddTicketModal() {
      const form = document.getElementById('modalTicketForm');
      form.action = "{{ route('admin.tiket.store') }}";
      
      document.getElementById('adminModalTitle').textContent = 'Tambah Tiket Baru';
      document.getElementById('inputTicketName').value = '';
      document.getElementById('inputTicketPrice').value = '';
      document.getElementById('inputTicketCategory').value = 'Reguler';
      document.getElementById('inputTicketQuota').value = '250';
      document.getElementById('inputTicketImg').value = 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60';
      document.getElementById('inputTicketBenefits').value = "Jersey\nMedali Finisher\nE-Sertifikat";
      document.getElementById('btnSubmitModal').textContent = 'Tambah Tiket Baru';

      document.getElementById('adminatorTicketModal').style.display = 'flex';
    }

    function openEditTicketModal(ticket) {
      const form = document.getElementById('modalTicketForm');
      form.action = "/admin/tiket/" + ticket.id + "/update";

      document.getElementById('adminModalTitle').textContent = 'Edit Tiket #' + ticket.id + ' (' + ticket.name + ')';
      document.getElementById('inputTicketName').value = ticket.name || '';
      document.getElementById('inputTicketPrice').value = ticket.price || 0;
      document.getElementById('inputTicketCategory').value = ticket.category || '';
      document.getElementById('inputTicketQuota').value = ticket.quota || 100;
      document.getElementById('inputTicketImg').value = ticket.image || '';
      
      // Format benefits if separated by comma or newline
      let rawBenefits = ticket.benefits || '';
      let formatted = rawBenefits.split(/[\r\n,]+/).map(s => s.trim()).filter(Boolean).join('\n');
      document.getElementById('inputTicketBenefits').value = formatted;

      document.getElementById('btnSubmitModal').textContent = 'Simpan Perubahan';

      document.getElementById('adminatorTicketModal').style.display = 'flex';
    }

    function confirmDeleteTicket(id, name) {
      openDeleteTicketModal(id, name);
    }

    // Keyboard Escape to close modals
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeTicketAdminModal();
        closeDeleteTicketModal();
      }
    });
  </script>
</body>
</html>
