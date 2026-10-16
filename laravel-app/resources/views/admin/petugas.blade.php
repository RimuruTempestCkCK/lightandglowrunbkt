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
  <title>Data Petugas Scanner · Light And Glow Bukittinggi</title>
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
<body data-active="petugas" data-crumbs="Laporan & Petugas | Data Petugas" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
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
            <span class="eyebrow">Manajemen Akses & Database</span>
            <h1 class="hero-title">Akun Petugas <span class="accent">Scanner Gate</span></h1>
            <p class="hero-sub">Kelola akun petugas lapangan, tambah akun petugas baru, ubah kredensial nama/email/password, dan hapus akun petugas di database MySQL.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="openAddStaffModal()">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Petugas Baru
            </button>
          </div>
        </section>

        <!-- Table Petugas -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Pengguna Sistem</span>
              <h2 class="card-title">Petugas Validasi QR Code & Akses Internal</h2>
            </div>
          </div>

          <div class="table-scroll">
            <table class="table" style="width: 100%; min-width: 700px;">
              <thead>
                <tr>
                  <th style="width:60px; white-space:nowrap;">ID</th>
                  <th style="white-space:nowrap;">Nama Lengkap</th>
                  <th style="white-space:nowrap;">Email Akses Login</th>
                  <th style="white-space:nowrap;">Peran / Role</th>
                  <th style="white-space:nowrap;">Status</th>
                  <th style="text-align:right; white-space:nowrap;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($staff as $u)
                  <tr>
                    <td><strong>#{{ $u->id }}</strong></td>
                    <td>
                      <strong style="font-size:14px; color:var(--t-base);">{{ $u->name }}</strong>
                      @if($u->id == 1)
                        <span class="tag" style="background:rgba(37,99,235,0.12); color:var(--primary); font-size:10px; margin-left:6px;">Utama</span>
                      @endif
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>
                      @if($u->id == 1)
                        <span class="tag" style="background:rgba(139,92,246,0.15); color:#8B5CF6; font-weight:700;">Super Administrator</span>
                      @else
                        <span class="tag" style="background:rgba(14,165,233,0.15); color:#0284C7; font-weight:700;">Petugas Scanner Gate</span>
                      @endif
                    </td>
                    <td>
                      <span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; font-weight:700;">Aktif</span>
                    </td>
                    <td style="text-align:right;">
                      <div style="display:inline-flex; gap:6px;">
                        <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px;" onclick='openEditStaffModal(@json($u))'>
                          Edit
                        </button>
                        @if($u->id != 1)
                          <button class="btn btn--ghost" style="padding:4px 10px; font-size:12px; color:var(--danger);" onclick="confirmDeleteStaff({{ $u->id }}, '{{ addslashes($u->name) }}')">
                            Hapus
                          </button>
                          <!-- Form Delete Hidden -->
                          <form id="delete-staff-form-{{ $u->id }}" action="{{ route('admin.petugas.delete', $u->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                          </form>
                        @endif
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center; padding:32px; color:var(--t-muted);">
                      Belum ada data petugas di database.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Tambah / Edit Petugas) -->
  <div id="adminatorStaffModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeStaffModal()">
    <div class="adminator-modal" style="max-width:500px; width:92%;">
      <div class="adminator-modal-head">
        <h3 id="staffModalTitle" class="adminator-modal-title">Tambah Petugas Baru</h3>
        <button type="button" class="adminator-modal-close" onclick="closeStaffModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <form id="staffForm" method="POST" action="{{ route('admin.petugas.store') }}">
        @csrf
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:14px;">
            <div class="field">
              <label class="field-label">Nama Lengkap Petugas <span class="req">*</span></label>
              <input type="text" id="staffName" name="name" class="input" placeholder="Contoh: Alex Pratama" required>
            </div>
            <div class="field">
              <label class="field-label">Email Akses Login <span class="req">*</span></label>
              <input type="email" id="staffEmail" name="email" class="input" placeholder="Contoh: alex.gate1@lightandglow.id" required>
            </div>
            <div class="field">
              <label class="field-label" id="labelPassword">Kata Sandi / Password <span class="req">*</span></label>
              <input type="password" id="staffPassword" name="password" class="input" placeholder="Minimal 6 karakter" required>
              <small id="hintPassword" style="font-size:11px; color:var(--t-muted); display:none;">Kosongkan jika tidak ingin mengubah password.</small>
            </div>
          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeStaffModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitStaff">Simpan Petugas</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Adminator Modal Konfirmasi Hapus Petugas -->
  <div id="adminatorDeleteStaffModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeDeleteStaffModal()">
    <div class="adminator-modal" style="max-width:440px; width:92%;">
      <div class="adminator-modal-head">
        <h3 class="adminator-modal-title" style="color:var(--danger); display:flex; align-items:center; gap:8px;">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Konfirmasi Hapus Petugas
        </h3>
        <button type="button" class="adminator-modal-close" onclick="closeDeleteStaffModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <p style="margin:0 0 8px; font-size:14px; color:var(--t-base);">Apakah Anda yakin ingin menghapus akun petugas <strong id="deleteStaffNameLabel"></strong>?</p>
        <span style="font-size:12px; color:var(--t-muted); display:block; line-height:1.5;">Akun petugas ini akan dihapus permanen dari sistem dan tidak bisa login lagi. Tindakan ini tidak dapat dibatalkan.</span>
      </div>
      <div class="adminator-modal-foot">
        <button type="button" class="btn btn--ghost" onclick="closeDeleteStaffModal()">Batal</button>
        <button type="button" class="btn" style="background:#EF4444; color:#fff;" id="btnConfirmDeleteStaff" onclick="executeDeleteStaff()">Ya, Hapus Petugas</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let activeDeleteStaffId = null;

    function openDeleteStaffModal(id, name) {
      activeDeleteStaffId = id;
      document.getElementById('deleteStaffNameLabel').textContent = '"' + name + '"';
      document.getElementById('adminatorDeleteStaffModal').style.display = 'flex';
    }

    function closeDeleteStaffModal() {
      activeDeleteStaffId = null;
      document.getElementById('adminatorDeleteStaffModal').style.display = 'none';
    }

    function executeDeleteStaff() {
      if (activeDeleteStaffId) {
        const form = document.getElementById('delete-staff-form-' + activeDeleteStaffId);
        if (form) {
          form.submit();
        }
      }
    }

    function closeStaffModal() {
      document.getElementById('adminatorStaffModal').style.display = 'none';
    }

    function openAddStaffModal() {
      const form = document.getElementById('staffForm');
      form.action = "{{ route('admin.petugas.store') }}";

      document.getElementById('staffModalTitle').textContent = 'Tambah Petugas Baru';
      document.getElementById('staffName').value = '';
      document.getElementById('staffEmail').value = '';
      document.getElementById('staffPassword').value = '';
      document.getElementById('staffPassword').required = true;
      document.getElementById('hintPassword').style.display = 'none';
      document.getElementById('labelPassword').innerHTML = 'Kata Sandi / Password <span class="req">*</span>';
      document.getElementById('btnSubmitStaff').textContent = 'Simpan Petugas';

      document.getElementById('adminatorStaffModal').style.display = 'flex';
    }

    function openEditStaffModal(user) {
      const form = document.getElementById('staffForm');
      form.action = "/admin/petugas/" + user.id + "/update";

      document.getElementById('staffModalTitle').textContent = 'Edit Data Petugas #' + user.id;
      document.getElementById('staffName').value = user.name || '';
      document.getElementById('staffEmail').value = user.email || '';
      document.getElementById('staffPassword').value = '';
      document.getElementById('staffPassword').required = false;
      document.getElementById('hintPassword').style.display = 'block';
      document.getElementById('labelPassword').innerHTML = 'Ganti Kata Sandi (Opsional)';
      document.getElementById('btnSubmitStaff').textContent = 'Simpan Perubahan';

      document.getElementById('adminatorStaffModal').style.display = 'flex';
    }

    function confirmDeleteStaff(id, name) {
      openDeleteStaffModal(id, name);
    }

    // Keyboard Escape to close modals
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeStaffModal();
        closeDeleteStaffModal();
      }
    });
  </script>
</body>
</html>
