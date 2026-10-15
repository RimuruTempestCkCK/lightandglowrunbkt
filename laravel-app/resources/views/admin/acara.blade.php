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
  <title>Master Acara & Konten Promosi · Light And Glow Bukittinggi</title>
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
  </style>
</head>
<body data-active="acara_direct" data-crumbs="Master Data | Master Acara & Info">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Master Data</span>
            <h1 class="hero-title">Kelola <span class="accent">Acara & Konten Promosi</span></h1>
            <p class="hero-sub">Kelola identitas brand event, tagline judul section tiket, fitur komunitas runners, serta informasi kemitraan destinasi wisata.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="saveAcaraData()">
              <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Konten Acara
            </button>
          </div>
        </section>

        <!-- Brand Identity -->
        <div class="cms-card">
          <div class="cms-section-title">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            1. Identitas Brand & Navbar Logo
          </div>
          <div class="cms-form-group">
            <label class="cms-label" for="brandLogoText">Nama Brand / Logo Navbar</label>
            <input type="text" id="brandLogoText" class="cms-input" value="Light & Glow BKT">
          </div>
        </div>

        <!-- Section Tiket Header -->
        <div class="cms-card">
          <div class="cms-section-title">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg>
            2. Judul & Deskripsi Section Katalog Tiket
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

        <!-- Section Crowd -->
        <div class="cms-card">
          <div class="cms-section-title">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            3. Section Komunitas Runners (Fitur Crowd)
          </div>
          <div class="cms-form-group">
            <label class="cms-label" for="crowdTitle">Judul Crowd</label>
            <input type="text" id="crowdTitle" class="cms-input" value="Rasakan Atmosfer Pesta Cahaya & Musik Terbesar!">
          </div>
          <div class="cms-form-group">
            <label class="cms-label" for="crowdDesc">Deskripsi Crowd</label>
            <textarea id="crowdDesc" class="cms-textarea" rows="3">Bergabung bersama ribuan runners dan pecinta musik di bawah gemerlap langit malam Jam Gadang Bukittinggi.</textarea>
          </div>
        </div>

        <!-- Section GEM & Wisata -->
        <div class="cms-card">
          <div class="cms-section-title">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            4. Section Pesona Wisata & Solusi Partner (GEM)
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

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function getStorageData() {
      const raw = localStorage.getItem('goers_full_cms');
      return raw ? JSON.parse(raw) : {};
    }

    function saveStorageData(cmsData) {
      localStorage.setItem('goers_full_cms', JSON.stringify(cmsData));
    }

    function loadData() {
      const cms = getStorageData();
      if (cms.brandLogoText) document.getElementById('brandLogoText').value = cms.brandLogoText;
      if (cms.concertHeaderTitle) document.getElementById('concertHeaderTitle').value = cms.concertHeaderTitle;
      if (cms.concertHeaderDesc) document.getElementById('concertHeaderDesc').value = cms.concertHeaderDesc;
      if (cms.crowdTitle) document.getElementById('crowdTitle').value = cms.crowdTitle;
      if (cms.crowdDesc) document.getElementById('crowdDesc').value = cms.crowdDesc;
      if (cms.gemTitle) document.getElementById('gemTitle').value = cms.gemTitle;
      if (cms.gemDesc) document.getElementById('gemDesc').value = cms.gemDesc;
    }

    function saveAcaraData() {
      const cms = getStorageData();
      cms.brandLogoText = document.getElementById('brandLogoText').value;
      cms.concertHeaderTitle = document.getElementById('concertHeaderTitle').value;
      cms.concertHeaderDesc = document.getElementById('concertHeaderDesc').value;
      cms.crowdTitle = document.getElementById('crowdTitle').value;
      cms.crowdDesc = document.getElementById('crowdDesc').value;
      cms.gemTitle = document.getElementById('gemTitle').value;
      cms.gemDesc = document.getElementById('gemDesc').value;

      saveStorageData(cms);
      Swal.fire({
        icon: 'success',
        title: 'Konten Acara Disimpan!',
        text: 'Informasi acara dan brand berhasil dipublikasikan ke Landing Page.',
        confirmButtonColor: '#EB1355'
      });
    }

    document.addEventListener('DOMContentLoaded', loadData);
  </script>
</body>
</html>
