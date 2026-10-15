<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>CMS Landing Page · Light And Glow Bukittinggi</title>
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
    .cms-container {
      max-width: 900px;
      margin: 0 auto;
    }
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
      font-size: 14px;
      font-family: inherit;
      outline: none;
      transition: border-color 0.2s ease;
    }
    .cms-input:focus, .cms-textarea:focus {
      border-color: var(--primary);
    }
    .cms-actions {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 12px;
      margin-top: 24px;
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #10B981;
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 20px;
      display: none;
    }
  </style>
</head>
<body data-active="cms" data-crumbs="Utama | CMS Landing Page">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Content Management System</span>
            <h1 class="hero-title">CMS <span class="accent">Landing Page</span></h1>
            <p class="hero-sub">Kelola konten, teks banner hero, judul acara, dan penawaran di landing page secara realtime dari dashboard ini.</p>
          </div>
          <div class="hero-actions">
            <a href="{{ url('/') }}" target="_blank" class="btn btn--ghost">
              <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              Pratinjau Live
            </a>
            <button class="btn btn--primary" onclick="saveCmsData()">
              <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Perubahan
            </button>
          </div>
        </section>

        <div class="cms-container">
          <div id="saveAlert" class="alert-success">
            ✓ Perubahan teks landing page berhasil disimpan! Anda dapat membuka halaman depan untuk melihat hasilnya.
          </div>

          <!-- Section 1: Top Bar & Hero -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
              1. Header & Hero Banner Utama
            </div>
            
            <div class="cms-form-group">
              <label class="cms-label" for="topBar">Teks Top Announcement Bar</label>
              <input type="text" id="topBar" class="cms-input" value="⚡ Jelajah event musik, wisata & aktivitas terbaik. <strong>Diskon s/d 50%</strong>">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="heroTag">Badge Tagline Hero</label>
              <input type="text" id="heroTag" class="cms-input" value="Trending Festival 2026">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="heroTitle">Judul Utama Hero Banner</label>
              <input type="text" id="heroTitle" class="cms-input" value="Soundwave Jakarta Fest 2026: Live Stage">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="heroDesc">Deskripsi Hero Banner</label>
              <textarea id="heroDesc" class="cms-textarea" rows="3">Saksikan penampilan musisi papan atas Indonesia dan internasional secara langsung di GBK Senayan. Dapatkan tiket presale sekarang sebelum kehabisan!</textarea>
            </div>
          </div>

          <!-- Section 2: Acara & Konser -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
              2. Section Acara & Konser
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="concertTitle">Judul Section Konser</label>
              <input type="text" id="concertTitle" class="cms-input" value="Konser Musik & Festival Paling Hits">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="concertDesc">Sub-judul Section Konser</label>
              <input type="text" id="concertDesc" class="cms-input" value="Temukan tiket konser musisi favoritmu dengan harga terbaik dan konfirmasi instan">
            </div>
          </div>

          <!-- Section 3: Fitur CROWD -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              3. Section Fitur CROWD
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="crowdTitle">Judul Utama Crowd (Mendukung Tag HTML)</label>
              <input type="text" id="crowdTitle" class="cms-input" value="Jangan sampai rencana cuma jadi wacana. <span>Post, cari teman, langsung jalan!</span>">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="crowdDesc">Deskripsi Fitur Crowd</label>
              <textarea id="crowdDesc" class="cms-textarea" rows="3">Pergi sendirian itu valid. Tapi pergi bareng itu core memory! Crowd membantumu menemukan teman baru yang mau melakukan aktivitas seru di dunia nyata. Konser, nobar, kulineran, hingga jalan santai di museum.</textarea>
            </div>
          </div>

          <div class="cms-actions">
            <button class="btn btn--ghost" onclick="resetCmsData()">Kembalikan Default</button>
            <button class="btn btn--primary" onclick="saveCmsData()">Simpan & Publikasikan ke Landing Page</button>
          </div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script>
    // Load existing values from localStorage
    document.addEventListener('DOMContentLoaded', () => {
      try {
        const saved = localStorage.getItem('goers_landing_cms');
        if (saved) {
          const d = JSON.parse(saved);
          if (d.topBar) document.getElementById('topBar').value = d.topBar;
          if (d.heroTag) document.getElementById('heroTag').value = d.heroTag;
          if (d.heroTitle) document.getElementById('heroTitle').value = d.heroTitle;
          if (d.heroDesc) document.getElementById('heroDesc').value = d.heroDesc;
          if (d.concertTitle) document.getElementById('concertTitle').value = d.concertTitle;
          if (d.concertDesc) document.getElementById('concertDesc').value = d.concertDesc;
          if (d.crowdTitle) document.getElementById('crowdTitle').value = d.crowdTitle;
          if (d.crowdDesc) document.getElementById('crowdDesc').value = d.crowdDesc;
        }
      } catch (e) {
        console.error(e);
      }
    });

    function saveCmsData() {
      const data = {
        topBar: document.getElementById('topBar').value,
        heroTag: document.getElementById('heroTag').value,
        heroTitle: document.getElementById('heroTitle').value,
        heroDesc: document.getElementById('heroDesc').value,
        concertTitle: document.getElementById('concertTitle').value,
        concertDesc: document.getElementById('concertDesc').value,
        crowdTitle: document.getElementById('crowdTitle').value,
        crowdDesc: document.getElementById('crowdDesc').value,
      };
      localStorage.setItem('goers_landing_cms', JSON.stringify(data));
      
      const alertBox = document.getElementById('saveAlert');
      alertBox.style.display = 'block';
      setTimeout(() => {
        alertBox.style.display = 'none';
      }, 5000);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetCmsData() {
      if (confirm('Apakah Anda yakin ingin mengembalikan teks ke bawaan awal?')) {
        localStorage.removeItem('goers_landing_cms');
        location.reload();
      }
    }
  </script>
</body>
</html>
