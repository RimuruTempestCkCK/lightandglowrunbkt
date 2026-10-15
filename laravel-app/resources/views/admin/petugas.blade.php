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
  <title>Akun Petugas Check-in · Light And Glow Bukittinggi</title>
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
<body data-active="petugas" data-crumbs="Petugas | Akun Petugas Scanner">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Manajemen Akses</span>
            <h1 class="hero-title">Akun Petugas <span class="accent">Scanner Gate</span></h1>
            <p class="hero-sub">Kelola akun petugas lapangan, berikan hak akses scanning QR Code sesuai lokasi gate dan acara yang ditugaskan.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="addStaff()">
              <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Petugas Baru
            </button>
          </div>
        </section>

        <!-- Table Petugas -->
        <div class="card" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Petugas Aktif</span>
              <h2 class="card-title">Petugas Validasi QR Code di Lokasi Acara</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>Nama Petugas</th>
                <th>Username / Email</th>
                <th>Acara Ditugaskan</th>
                <th>Posisi Gate</th>
                <th>Status Akun</th>
                <th style="text-align:right;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Alex Pratama</strong></td>
                <td>alex.gate1@lightandglow.id</td>
                <td>Light And Glow Bukittinggi 2026</td>
                <td><span class="tag" style="background:rgba(56,189,248,0.2); color:#0284C7; font-weight:700;">Gate 1 (Utama)</span></td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; font-weight:700;">Aktif</span></td>
                <td style="text-align:right;">
                  <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px;" onclick="resetPassword('Alex Pratama')">Reset Sandi</button>
                </td>
              </tr>
              <tr>
                <td><strong>Bunga Maharani</strong></td>
                <td>bunga.gate2@lightandglow.id</td>
                <td>Light And Glow Bukittinggi 2026</td>
                <td><span class="tag" style="background:rgba(56,189,248,0.2); color:#0284C7; font-weight:700;">Gate 2 (VIP Pass)</span></td>
                <td><span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; font-weight:700;">Aktif</span></td>
                <td style="text-align:right;">
                  <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px;" onclick="resetPassword('Bunga Maharani')">Reset Sandi</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Native Template Modal Popup -->
  <div id="adminatorStaffModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeStaffModal()">
    <div class="adminator-modal">
      <div class="adminator-modal-head">
        <h3 id="staffModalTitle" class="adminator-modal-title">Tambah Petugas Baru</h3>
        <button class="adminator-modal-close" onclick="closeStaffModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <form id="staffForm" onsubmit="saveStaff(event)">
        <div class="adminator-modal-body">
          <div class="field">
            <label class="field-label">Nama Petugas</label>
            <input type="text" id="staffName" class="input" placeholder="Contoh: Ridho Illahi" required>
          </div>
          <div class="field">
            <label class="field-label">Email / Username Petugas</label>
            <input type="email" id="staffEmail" class="input" placeholder="Contoh: ridho@lightandglow.id" required>
          </div>
          <div class="field">
            <label class="field-label">Penugasan Acara</label>
            <input type="text" id="staffEvent" class="input" value="Light And Glow Bukittinggi 2026" required>
          </div>
          <div class="field">
            <label class="field-label">Posisi Gate</label>
            <input type="text" id="staffGate" class="input" value="Gate 1 (Utama)" required>
          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeStaffModal()">Batal</button>
          <button type="submit" class="btn btn--primary">Buat Akun Petugas</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function openStaffModal() {
      document.getElementById('staffForm').reset();
      document.getElementById('staffEvent').value = "Light And Glow Bukittinggi 2026";
      document.getElementById('staffGate').value = "Gate 1 (Utama)";
      document.getElementById('adminatorStaffModal').style.display = 'flex';
    }

    function closeStaffModal() {
      document.getElementById('adminatorStaffModal').style.display = 'none';
    }

    function addStaff() {
      openStaffModal();
    }

    function saveStaff(e) {
      e.preventDefault();
      const name = document.getElementById('staffName').value.trim();
      const email = document.getElementById('staffEmail').value.trim();
      const gate = document.getElementById('staffGate').value.trim();

      closeStaffModal();

      // Gunakan SweetAlert HANYA untuk notifikasi berhasil
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Ditambahkan!',
        text: `Akun petugas ${name} (${gate}) berhasil dibuat dan siap bertugas.`,
        confirmButtonColor: '#EB1355'
      });
    }

    function resetPassword(name) {
      Swal.fire({
        title: `Reset Password ${name}?`,
        text: 'Password sementara akan di-generate dan dikirim ke petugas.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Reset Password',
        cancelButtonText: 'Batal'
      }).then((res) => {
        if (res.isConfirmed) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Diedit!',
            text: 'Password baru petugas telah diperbarui.',
            confirmButtonColor: '#10B981'
          });
        }
      });
    }
  </script>
</body>
</html>
