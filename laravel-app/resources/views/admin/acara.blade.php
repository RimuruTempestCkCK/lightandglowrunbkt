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
      width: 160px;
      height: 160px;
      border: 2px dashed var(--border);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: #fff;
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

        <!-- Hero Section (Bersih tanpa tombol Lihat di Web dan tanpa KPI Card) -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Database MySQL Real-Time</span>
            <h1 class="hero-title">Master <span class="accent">Acara & QRIS Pembayaran</span></h1>
            <p class="hero-sub">Kelola kode barcode QRIS resmi untuk pembelian tiket pembeli, informasi rekening merchant, serta konten promosi event Light And Glow.</p>
          </div>
          <div class="hero-actions">
            <button type="submit" form="formAcaraDatabase" class="btn btn--primary">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Perubahan
            </button>
          </div>
        </section>

        <form id="formAcaraDatabase" action="{{ route('admin.acara.update') }}" method="POST">
          @csrf

          <!-- 1. KELOLA QRIS PEMBAYARAN TIKET (TERINTEGRASI DATABASE) -->
          <div class="cms-card" style="border: 2px solid var(--primary-soft); background: var(--bg-card);">
            <div class="cms-section-title" style="color:var(--primary);">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              1. Pengaturan QRIS Pembayaran Tiket Pembeli (Database)
            </div>
            <p style="font-size:13px; color:var(--t-muted); margin-bottom:16px;">
              Kode QRIS yang Anda pasang di sini akan <strong>otomatis tampil pada saat pembeli melakukan checkout pembelian tiket</strong> di halaman web pembeli.
            </p>

            <div style="display:grid; grid-template-columns: 180px 1fr; gap:20px; align-items:start;">
              <div>
                <label class="cms-label">Preview Gambar QRIS</label>
                <div class="qris-preview-box">
                  <img id="qrisImgPreview" src="{{ $event->qris_image ?? 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8' }}" alt="QRIS Pembayaran">
                </div>
                <span style="display:block; font-size:11px; color:var(--t-muted); margin-top:6px; text-align:center;">QRIS Aktif Saat Checkout</span>
              </div>

              <div>
                <div class="cms-form-group">
                  <label class="cms-label" for="qris_image">URL / Link Foto Barcode QRIS Resmi</label>
                  <input type="text" id="qris_image" name="qris_image" class="cms-input" placeholder="https://... atau /uploads/qris.png" value="{{ $event->qris_image ?? '' }}" oninput="updateQrisPreview(this.value)">
                  <span style="font-size:11.5px; color:var(--t-muted); margin-top:4px; display:block;">
                    *Jika dikosongkan, sistem akan otomatis menghasilkan Barcode QRIS Dinamis standar nasional dengan payload nomor pesanan unik.
                  </span>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
                  <div class="cms-form-group">
                    <label class="cms-label" for="qris_merchant_name">Nama Akun Merchant QRIS</label>
                    <input type="text" id="qris_merchant_name" name="qris_merchant_name" class="cms-input" value="{{ $event->qris_merchant_name ?? 'LIGHT AND GLOW BUKITTINGGI' }}">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label" for="qris_nmid">NMID QRIS (Opsional)</label>
                    <input type="text" id="qris_nmid" name="qris_nmid" class="cms-input" placeholder="ID102026xxxxxxxxx" value="{{ $event->qris_nmid ?? '' }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 2. Informasi Utama Event Acara (Database) -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              2. Data Jadwal & Lokasi Event Acara
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="eventTitle">Nama Acara</label>
              <input type="text" id="eventTitle" name="title" class="cms-input" value="{{ $event->title ?? 'Light And Glow Bukittinggi 2026' }}">
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
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

          <!-- 3. Identitas Brand & Navbar Logo -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
              3. Identitas Brand & Navbar Logo
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="brandLogoText">Nama Brand / Logo Navbar</label>
              <input type="text" id="brandLogoText" class="cms-input" value="Light & Glow BKT">
            </div>
          </div>

          <!-- 4. Section Tiket Header -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
              4. Judul & Deskripsi Section Katalog Tiket
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="concertHeaderTitle">Judul Section Tiket</label>
              <input type="text" id="concertHeaderTitle" class="cms-input" value="Daftar Tiket & Konser">
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="concertHeaderDesc">Deskripsi Section Tiket</label>
              <input type="text" id="concertHeaderDesc" class="cms-input" value="Pilih tiket favoritmu sebelum kuota habis! Setiap tiket sudah termasuk nomor dada & starter pack.">
            </div>
          </div>

          <!-- 5. Fitur Komunitas Pelari (Crowd) -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              5. Section Komunitas Pelari (Crowd)
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="crowdTitle">Judul Komunitas</label>
              <input type="text" id="crowdTitle" class="cms-input" value="Lebih dari Sekadar Lari Malam">
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="crowdDesc">Deskripsi Komunitas</label>
              <textarea id="crowdDesc" class="cms-textarea" rows="3">Sebuah perayaan olahraga, musik neon glow, dan pariwisata yang mempertemukan ribuan pelari dari berbagai penjuru tanah air di Bukittinggi.</textarea>
            </div>
          </div>

          <!-- 6. Section Pesona Wisata & Solusi Partner (GEM) -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              6. Section Pesona Wisata & Solusi Partner (GEM)
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="gemTitle">Judul Solusi / Pesona Wisata</label>
              <input type="text" id="gemTitle" class="cms-input" value="Jelajahi Pesona Wisata & Kuliner Bukittinggi">
            </div>
            <div class="cms-form-group">
              <label class="cms-label" for="gemDesc">Deskripsi Wisata</label>
              <textarea id="gemDesc" class="cms-textarea" rows="3">Nikmati keindahan Ngarai Sianok, Jam Gadang, dan kuliner khas Minangkabau sembari mengikuti event konser Light And Glow.</textarea>
            </div>
          </div>

          <div style="text-align: right; margin-bottom: 40px;">
            <button type="submit" class="btn btn--primary" style="padding: 12px 24px; font-size: 14px;">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Semua Perubahan ke Database
            </button>
          </div>
        </form>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script>
    function updateQrisPreview(val) {
      const img = document.getElementById('qrisImgPreview');
      if (val && val.trim() !== '') {
        img.src = val;
      } else {
        img.src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8';
      }
    }

    function getStorageData() {
      const raw = localStorage.getItem('goers_full_cms');
      return raw ? JSON.parse(raw) : {};
    }

    function saveStorageData(cmsData) {
      localStorage.setItem('goers_full_cms', JSON.stringify(cmsData));
    }

    function loadLocalStorageData() {
      const cms = getStorageData();
      if (cms.brandLogoText) document.getElementById('brandLogoText').value = cms.brandLogoText;
      if (cms.concertHeaderTitle) document.getElementById('concertHeaderTitle').value = cms.concertHeaderTitle;
      if (cms.concertHeaderDesc) document.getElementById('concertHeaderDesc').value = cms.concertHeaderDesc;
      if (cms.crowdTitle) document.getElementById('crowdTitle').value = cms.crowdTitle;
      if (cms.crowdDesc) document.getElementById('crowdDesc').value = cms.crowdDesc;
      if (cms.gemTitle) document.getElementById('gemTitle').value = cms.gemTitle;
      if (cms.gemDesc) document.getElementById('gemDesc').value = cms.gemDesc;
    }

    document.getElementById('formAcaraDatabase').addEventListener('submit', function() {
      const cms = getStorageData();
      cms.brandLogoText = document.getElementById('brandLogoText').value;
      cms.concertHeaderTitle = document.getElementById('concertHeaderTitle').value;
      cms.concertHeaderDesc = document.getElementById('concertHeaderDesc').value;
      cms.crowdTitle = document.getElementById('crowdTitle').value;
      cms.crowdDesc = document.getElementById('crowdDesc').value;
      cms.gemTitle = document.getElementById('gemTitle').value;
      cms.gemDesc = document.getElementById('gemDesc').value;
      saveStorageData(cms);
    });

    document.addEventListener('DOMContentLoaded', loadLocalStorageData);
  </script>
</body>
</html>
