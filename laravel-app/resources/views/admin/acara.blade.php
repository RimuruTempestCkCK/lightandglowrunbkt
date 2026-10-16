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
  <title>Master Acara & QRIS Pembayaran · Light And Glow Bukittinggi</title>
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
    .cms-card {
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 12px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .cms-section-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--t-base);
      margin-bottom: 16px;
      padding-bottom: 10px;
      border-bottom: 1px solid var(--border-soft);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .cms-form-group {
      margin-bottom: 16px;
    }
    .cms-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--t-muted);
      margin-bottom: 6px;
    }
    .cms-input, .cms-textarea {
      width: 100%;
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid var(--border);
      background: var(--bg-body);
      color: var(--t-base);
      font-family: inherit;
      font-size: 14px;
      transition: border-color .15s;
    }
    .cms-input:focus, .cms-textarea:focus {
      outline: none;
      border-color: var(--primary);
    }
    .qris-preview-box {
      width: 200px;
      height: 200px;
      border: 2px dashed var(--border);
      border-radius: 12px;
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
<body data-active="acara_direct" data-crumbs="Master Data | Master Acara & QRIS Pembayaran">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Notifikasi Flash -->
        @if(session('success'))
          <div style="background:rgba(16,185,129,0.15); border:1px solid #10b981; color:#059669; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; font-weight:600; display:flex; align-items:center; gap:8px;">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div style="background:rgba(239,68,68,0.15); border:1px solid #ef4444; color:#dc2626; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; font-weight:600;">
            <ul style="margin:0; padding-left:20px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Header Section Bersih & Ringkas -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Pengaturan Sistem</span>
            <h1 class="hero-title">QRIS & <span class="accent">Acara</span></h1>
            <p class="hero-sub">Kelola barcode QRIS pembayaran tiket dan informasi utama event Light And Glow.</p>
          </div>
          <div class="hero-actions">
            <button type="submit" form="formAcaraDatabase" class="btn btn--primary">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Perubahan
            </button>
          </div>
        </section>

        <form id="formAcaraDatabase" action="{{ route('admin.acara.update') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- QRIS PEMBAYARAN TIKET -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              QRIS Pembayaran Tiket
            </div>

            <div style="display:grid; grid-template-columns: 180px 1fr; gap:20px; align-items:start;">
              <div>
                <div class="qris-preview-box" style="width:180px; height:180px;">
                  <img id="qrisImgPreview" src="{{ !empty($event->qris_image) ? asset($event->qris_image) : 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8' }}" alt="QRIS">
                </div>
                <span style="display:block; font-size:11px; color:var(--t-muted); text-align:center;">Preview QRIS Aktif</span>
              </div>

              <div>
                <div class="cms-form-group">
                  <label class="cms-label" for="qris_file">Unggah Gambar QRIS Baru</label>
                  <input type="file" id="qris_file" name="qris_file" class="cms-input" accept="image/*" onchange="previewUploadedQris(this)">
                  <span style="font-size:11px; color:var(--t-muted); margin-top:4px; display:block;">
                    Format JPG, PNG, atau WEBP. Otomatis tampil di halaman checkout pembeli.
                  </span>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px;">
                  <div class="cms-form-group">
                    <label class="cms-label" for="qris_merchant_name">Nama Merchant</label>
                    <input type="text" id="qris_merchant_name" name="qris_merchant_name" class="cms-input" value="{{ $event->qris_merchant_name ?? 'LIGHT AND GLOW BUKITTINGGI' }}" placeholder="LIGHT AND GLOW">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label" for="qris_nmid">NMID (Opsional)</label>
                    <input type="text" id="qris_nmid" name="qris_nmid" class="cms-input" placeholder="ID102026xxxxxxxxx" value="{{ $event->qris_nmid ?? '' }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- INFORMASI ACARA -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              Informasi Acara
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="eventTitle">Nama Acara</label>
              <input type="text" id="eventTitle" name="title" class="cms-input" value="{{ $event->title ?? 'Light And Glow Bukittinggi 2026' }}">
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:14px;">
              <div class="cms-form-group">
                <label class="cms-label" for="eventLocation">Lokasi Venue</label>
                <input type="text" id="eventLocation" name="location" class="cms-input" value="{{ $event->location ?? 'Jam Gadang, Bukittinggi' }}">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="eventDate">Tanggal Pelaksanaan</label>
                <input type="date" id="eventDate" name="event_date" class="cms-input" value="{{ $event->event_date ?? '2026-10-24' }}">
              </div>
            </div>
          </div>
        </form>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script>
    function previewUploadedQris(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('qrisImgPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
