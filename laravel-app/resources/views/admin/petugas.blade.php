<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function addStaff() {
      Swal.fire({
        title: 'Tambah Petugas Baru',
        html: `
          <div style="text-align:left; font-size:13px; display:flex; flex-direction:column; gap:10px;">
            <div>
              <label><b>Nama Petugas:</b></label>
              <input id="swal-sname" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: Ridho Illahi">
            </div>
            <div>
              <label><b>Email / Username:</b></label>
              <input id="swal-smail" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: ridho@lightandglow.id">
            </div>
            <div>
              <label><b>Penugasan Gate:</b></label>
              <input id="swal-sgate" class="swal2-input" style="width:100%; margin:4px 0 0;" value="Gate 1 (Utama)">
            </div>
          </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Buat Akun Petugas',
        cancelButtonText: 'Batal'
      }).then((res) => {
        if (res.isConfirmed) {
          Swal.fire({
            icon: 'success',
            title: 'Petugas Ditambahkan!',
            text: 'Akun petugas baru telah dibuat dan siap login ke menu Scanner QR.',
            confirmButtonColor: '#EB1355'
          });
        }
      });
    }

    function resetPassword(name) {
      Swal.fire({
        title: `Reset Password ${name}?`,
        text: 'Password sementara akan di-generate dan dikirim ke petugas.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Reset Password'
      }).then((res) => {
        if (res.isConfirmed) {
          Swal.fire({
            icon: 'success',
            title: 'Password Direset!',
            text: 'Password baru: LG2026!Gate',
            confirmButtonColor: '#10B981'
          });
        }
      });
    }
  </script>
</body>
</html>
