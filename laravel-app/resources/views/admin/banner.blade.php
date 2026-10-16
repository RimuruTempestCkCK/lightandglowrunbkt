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
  <title>Master Banner Hero · Light And Glow Bukittinggi</title>
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
    .banner-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 20px;
      margin-bottom: 24px;
    }
    .banner-card {
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 14px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .banner-img-wrap {
      position: relative;
      width: 100%;
      height: 190px;
      background: #111;
      overflow: hidden;
    }
    .banner-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .banner-card:hover .banner-img-wrap img {
      transform: scale(1.04);
    }
    .banner-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: var(--primary);
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 6px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .banner-content {
      padding: 18px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .banner-actions {
      display: flex;
      gap: 8px;
      border-top: 1px solid var(--border-soft);
      padding-top: 14px;
      justify-content: flex-end;
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
<body data-active="banner_direct" data-crumbs="Master Data | Kelola Gambar Banner Hero">
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
            <h1 class="hero-title">Kelola <span class="accent">Gambar Banner Hero</span></h1>
            <p class="hero-sub">Tambah dan edit gambar foto banner carousel yang tampil pada beranda landing page Light And Glow Bukittinggi.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="openAddBannerModal()">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Gambar Banner
            </button>
          </div>
        </section>

        <!-- Banner Grid -->
        <div class="banner-grid" id="bannerContainer">
          @forelse($banners as $index => $b)
            <div class="banner-card">
              <div class="banner-img-wrap">
                <img src="{{ asset(ltrim($b->image, '/')) }}" alt="Banner Slide {{ $index + 1 }}">
                <span class="banner-badge">Slide #{{ $b->order_index ?? ($index + 1) }}</span>
              </div>
              <div class="banner-content">
                <div style="font-size:13px; font-weight:700; color:var(--t-base); margin-bottom:4px;">
                  Urutan Tampil: Urutan ke-{{ $b->order_index ?? ($index + 1) }}
                </div>
                <div style="font-size:11.5px; color:var(--t-muted); margin-bottom:12px;">
                  Status: <span style="color:#10B981; font-weight:600;">● Aktif di Carousel Beranda</span>
                </div>
                <div class="banner-actions">
                  <button class="btn btn--ghost" style="padding:5px 12px; font-size:12px;" onclick='openEditBannerModal(@json($b))'>
                    Edit Gambar
                  </button>
                  <button class="btn btn--ghost" style="padding:5px 12px; font-size:12px; color:var(--danger);" onclick="confirmDeleteBanner({{ $b->id }})">
                    Hapus
                  </button>
                </div>
                <!-- Form Delete Hidden -->
                <form id="delete-banner-form-{{ $b->id }}" action="{{ route('admin.banner.delete', $b->id) }}" method="POST" style="display:none;">
                  @csrf
                  @method('DELETE')
                </form>
              </div>
            </div>
          @empty
            <div style="grid-column: 1 / -1; background:var(--bg-card); border:1px solid var(--border-soft); border-radius:12px; padding:32px; text-align:center; color:var(--t-muted);">
              Belum ada gambar banner di database. Silakan klik tombol "Tambah Gambar Banner".
            </div>
          @endforelse
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Tambah / Edit Gambar Banner Saja) -->
  <div id="adminatorBannerModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeBannerAdminModal()">
    <div class="adminator-modal" style="max-width:500px; width:92%;">
      <form id="modalBannerForm" method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="adminator-modal-head">
          <h3 id="adminBannerModalTitle" class="adminator-modal-title">Tambah Gambar Banner</h3>
          <button type="button" class="adminator-modal-close" onclick="closeBannerAdminModal()" aria-label="Tutup">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:16px;">
            
            <div>
              <label class="field-label">Unggah Foto / Gambar Banner <span class="req">*</span></label>
              <input type="file" id="inputBannerFile" name="image_file" class="input" accept="image/png,image/jpeg,image/jpg,image/webp" onchange="previewUploadedBanner(this)">
              <input type="hidden" id="inputBannerImg" name="image" value="">
              <span style="font-size:11px; color:var(--t-muted); margin-top:4px; display:block;">
                Format foto: PNG, JPG, JPEG, atau WEBP. Rekomendasi resolusi lebar (1200x500 px).
              </span>
            </div>

            <div>
              <label class="field-label">Urutan Tampil Slide</label>
              <input type="number" id="inputBannerOrder" name="order_index" class="input" min="1" value="1">
            </div>

            <div>
              <label class="field-label">Preview Gambar Banner</label>
              <div style="border:1px dashed var(--border); border-radius:10px; padding:10px; text-align:center; background:var(--bg-body); min-height:130px; display:flex; align-items:center; justify-content:center;">
                <img id="bannerImgPreview" src="" alt="Preview" style="max-height:160px; max-width:100%; border-radius:8px; object-fit:cover; display:none;">
                <span id="bannerImgPlaceholder" style="font-size:12px; color:var(--t-muted);">Pilih file gambar untuk melihat preview</span>
              </div>
            </div>

          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeBannerAdminModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitBanner">Simpan Banner</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function previewUploadedBanner(input) {
      const img = document.getElementById('bannerImgPreview');
      const placeholder = document.getElementById('bannerImgPlaceholder');
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          img.src = e.target.result;
          img.style.display = 'block';
          placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function closeBannerAdminModal() {
      document.getElementById('adminatorBannerModal').style.display = 'none';
    }

    function openAddBannerModal() {
      const form = document.getElementById('modalBannerForm');
      form.action = "{{ route('admin.banner.store') }}";

      document.getElementById('adminBannerModalTitle').textContent = 'Tambah Gambar Banner Baru';
      document.getElementById('inputBannerFile').value = '';
      document.getElementById('inputBannerFile').required = true;
      document.getElementById('inputBannerImg').value = '';
      document.getElementById('inputBannerOrder').value = '1';
      document.getElementById('btnSubmitBanner').textContent = 'Simpan Banner';

      const img = document.getElementById('bannerImgPreview');
      const placeholder = document.getElementById('bannerImgPlaceholder');
      img.src = '';
      img.style.display = 'none';
      placeholder.style.display = 'inline';

      document.getElementById('adminatorBannerModal').style.display = 'flex';
    }

    function openEditBannerModal(banner) {
      const form = document.getElementById('modalBannerForm');
      form.action = "/admin/banner/" + banner.id + "/update";

      document.getElementById('adminBannerModalTitle').textContent = 'Edit Gambar Banner #' + banner.id;
      document.getElementById('inputBannerFile').value = '';
      document.getElementById('inputBannerFile').required = false;
      document.getElementById('inputBannerImg').value = banner.image || '';
      document.getElementById('inputBannerOrder').value = banner.order_index || '1';
      document.getElementById('btnSubmitBanner').textContent = 'Simpan Perubahan';

      const img = document.getElementById('bannerImgPreview');
      const placeholder = document.getElementById('bannerImgPlaceholder');
      if (banner.image) {
        img.src = "{{ asset('') }}" + banner.image.replace(/^\/+/, '');
        img.style.display = 'block';
        placeholder.style.display = 'none';
      } else {
        img.src = '';
        img.style.display = 'none';
        placeholder.style.display = 'inline';
      }

      document.getElementById('adminatorBannerModal').style.display = 'flex';
    }

    function confirmDeleteBanner(id) {
      Swal.fire({
        title: 'Hapus Banner?',
        text: 'Banner ini akan dihapus permanen dari carousel beranda.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-banner-form-' + id).submit();
        }
      });
    }
  </script>
</body>
</html>
