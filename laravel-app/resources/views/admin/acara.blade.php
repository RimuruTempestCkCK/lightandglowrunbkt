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
  <title>Kelola QRIS Pembayaran · Light And Glow Bukittinggi</title>
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
    .acara-table-wrap {
      overflow-x: auto;
      background: var(--bg-card);
      border-radius: 12px;
      border: 1px solid var(--border-soft);
      padding: 20px;
    }
    .thumb-qris {
      width: 56px;
      height: 56px;
      border-radius: 8px;
      object-fit: contain;
      background: #fff;
      border: 1px solid var(--border-soft);
      padding: 2px;
    }
    .empty-data-alert {
      color: #ef4444;
      font-weight: 600;
      font-size: 13px;
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
    .qris-preview-box {
      width: 140px;
      height: 140px;
      border: 2px dashed var(--border);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: #fff;
      margin-bottom: 8px;
    }
    .qris-preview-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  </style>
</head>
<body data-active="acara_direct" data-crumbs="Master Data | QRIS Pembayaran Tiket" data-user-name="{{ Auth::check() ? Auth::user()->name : '' }}" data-user-email="{{ Auth::check() ? Auth::user()->email : '' }}">
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
            <h1 class="hero-title">Kelola <span class="accent">QRIS Pembayaran</span></h1>
            <p class="hero-sub">Kelola barcode gambar QRIS toko/panitia dan nama akun merchant resmi untuk pembayaran tiket peserta.</p>
          </div>
          <div class="hero-actions">
            @if(!$event)
              <button class="btn btn--primary" onclick="openAddQrisModal()">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Data QRIS
              </button>
            @endif
          </div>
        </section>

        <!-- Tabel QRIS Pembayaran -->
        <div class="acara-table-wrap">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Data Database Terkini</span>
              <h2 class="card-title">Barcode & Informasi Rekening QRIS Pembayaran</h2>
            </div>
          </div>

          <table class="table" style="width: 100%; min-width: 750px;">
            <thead>
              <tr>
                <th style="width: 80px; white-space:nowrap;">Barcode QRIS</th>
                <th style="white-space:nowrap;">Nama Akun Merchant</th>
                <th style="white-space:nowrap;">Status Tampil</th>
                <th style="white-space:nowrap;">Terakhir Diperbarui</th>
                <th style="text-align: right; width: 100px; white-space:nowrap;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if($event)
                <tr>
                  <td>
                    @if(!empty($event->qris_image))
                      <img src="{{ asset($event->qris_image) }}" class="thumb-qris" alt="QRIS">
                    @else
                      <span class="tag" style="background:rgba(239,68,68,0.12); color:#ef4444; font-size:11px; font-weight:700;">Belum Upload</span>
                    @endif
                  </td>
                  <td>
                    <strong style="font-size:14px; color:var(--t-base);">{{ $event->qris_merchant_name ?? 'LIGHT AND GLOW BUKITTINGGI' }}</strong>
                    <span style="font-size:11px; color:var(--text-sub); display:block;">Metode: QRIS Dinamis & Statis</span>
                  </td>
                  <td>
                    <span class="tag" style="background:rgba(16,185,129,0.12); color:#10B981; font-weight:700;">
                      ● Aktif di Halaman Pembeli
                    </span>
                  </td>
                  <td>
                    <span style="font-size:12px; color:var(--t-muted);">
                      {{ !empty($event->updated_at) ? \Carbon\Carbon::parse($event->updated_at)->translatedFormat('d F Y H:i') : '-' }}
                    </span>
                  </td>
                  <td style="text-align: right;">
                    <button class="btn btn--primary" style="padding:6px 14px; font-size:12px;" onclick='openEditQrisModal(@json($event))'>
                      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4z"/></svg>
                      Edit QRIS
                    </button>
                  </td>
                </tr>
              @else
                <tr>
                  <td colspan="5" style="text-align:center; padding:36px 20px;">
                    <div class="empty-data-alert" style="margin-bottom: 12px;">
                      ⚠️ Belum ada data QRIS di database MySQL! Silakan klik tombol "Tambah Data QRIS" di atas untuk menambahkan data.
                    </div>
                    <button class="btn btn--primary" onclick="openAddQrisModal()">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                      Tambah Data QRIS Sekarang
                    </button>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Edit / Tambah QRIS Pembayaran Saja) -->
  <div id="adminatorAcaraModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeQrisModal()">
    <div class="adminator-modal" style="max-width:500px; width:92%;">
      <form id="modalAcaraForm" method="POST" action="{{ route('admin.acara.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="adminator-modal-head">
          <h3 id="adminAcaraModalTitle" class="adminator-modal-title">Edit QRIS Pembayaran</h3>
          <button type="button" class="adminator-modal-close" onclick="closeQrisModal()" aria-label="Tutup">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:16px;">
            
            <!-- Upload QRIS -->
            <div>
              <label class="field-label">Gambar Barcode QRIS <span class="req">*</span></label>
              <div style="display:flex; gap:16px; align-items:center; margin-top:6px;">
                <div class="qris-preview-box">
                  <img id="modalQrisPreview" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8" alt="Preview QRIS">
                </div>
                <div style="flex:1;">
                  <input type="file" id="modalQrisFile" name="qris_file" class="input" accept="image/*" onchange="previewModalQris(this)">
                  <span style="font-size:11px; color:var(--t-muted); margin-top:4px; display:block;">
                    Pilih file gambar QRIS toko/rekening resmi (JPG, PNG, WEBP). Maks. 5MB.
                  </span>
                </div>
              </div>
            </div>

            <!-- Merchant Name -->
            <div>
              <label class="field-label">Nama Akun Merchant QRIS <span class="req">*</span></label>
              <input id="inputMerchantName" name="qris_merchant_name" class="input" placeholder="LIGHT AND GLOW BUKITTINGGI" required>
              <span style="font-size:11px; color:var(--t-muted); margin-top:4px; display:block;">
                Nama merchant/toko yang tertera di aplikasi pembeli saat scan QRIS.
              </span>
            </div>

          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeQrisModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitModal">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function closeQrisModal() {
      document.getElementById('adminatorAcaraModal').style.display = 'none';
    }

    function openAddQrisModal() {
      document.getElementById('adminAcaraModalTitle').textContent = 'Tambah Data QRIS';
      document.getElementById('inputMerchantName').value = 'LIGHT AND GLOW BUKITTINGGI';
      document.getElementById('modalQrisPreview').src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8';
      document.getElementById('modalQrisFile').value = '';
      document.getElementById('btnSubmitModal').textContent = 'Simpan QRIS';

      document.getElementById('adminatorAcaraModal').style.display = 'flex';
    }

    function openEditQrisModal(event) {
      document.getElementById('adminAcaraModalTitle').textContent = 'Edit QRIS Pembayaran';
      document.getElementById('inputMerchantName').value = event.qris_merchant_name || 'LIGHT AND GLOW BUKITTINGGI';
      document.getElementById('modalQrisFile').value = '';

      if (event.qris_image) {
        document.getElementById('modalQrisPreview').src = "{{ asset('') }}" + event.qris_image.replace(/^\/+/, '');
      } else {
        document.getElementById('modalQrisPreview').src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8';
      }

      document.getElementById('btnSubmitModal').textContent = 'Simpan Perubahan';
      document.getElementById('adminatorAcaraModal').style.display = 'flex';
    }

    function previewModalQris(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('modalQrisPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
