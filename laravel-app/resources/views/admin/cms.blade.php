<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>CMS Pengaturan Landing Page Lengkap · Light And Glow Bukittinggi</title>
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
      max-width: 1000px;
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
    .cms-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    @media (max-width: 768px) {
      .cms-grid-2 { grid-template-columns: 1fr; }
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
      position: sticky;
      bottom: 20px;
      background: var(--bg-card);
      padding: 16px 20px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      z-index: 100;
      border: 1px solid var(--border);
    }
    .ticket-editor-card {
      border: 1px dashed var(--border);
      padding: 16px;
      border-radius: 8px;
      margin-bottom: 16px;
      background: var(--bg-body);
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
<body data-active="cms" data-crumbs="Utama | CMS Landing Page Lengkap">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Full Landing Page CMS</span>
            <h1 class="hero-title">Pengaturan <span class="accent">Semua Konten Landing Page</span></h1>
            <p class="hero-sub">Ubah teks banner, gambar hero slider, daftar tiket konser & harga, tempat wisata, hingga teks footer secara langsung dari dashboard ini.</p>
          </div>
          <div class="hero-actions">
            <a href="{{ url('/') }}" target="_blank" class="btn btn--ghost">
              <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              Buka Landing Page (Live)
            </a>
            <button class="btn btn--primary" onclick="saveFullCmsData()">
              <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Simpan Semua Perubahan
            </button>
          </div>
        </section>

        <div class="cms-container">
          <div id="saveAlert" class="alert-success">
            ✓ Seluruh konten landing page (Banner, Daftar Tiket, Deskripsi, dan Gambar) berhasil disimpan dan aktif di halaman depan!
          </div>

          <!-- Section 1: Header & Announcement -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
              1. Top Bar & Logo Brand
            </div>
            <div class="cms-grid-2">
              <div class="cms-form-group">
                <label class="cms-label" for="brandLogoText">Nama Logo Brand</label>
                <input type="text" id="brandLogoText" class="cms-input" value="GOERS">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="topBarText">Teks Pengumuman Top Bar</label>
                <input type="text" id="topBarText" class="cms-input" value="⚡ Jelajah event musik, wisata & aktivitas terbaik. <strong>Diskon s/d 50%</strong>">
              </div>
            </div>
          </div>

          <!-- Section 2: Banner Hero Slider (3 Slide) -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              2. Banner Carousel Hero (Slide 1, 2, 3)
            </div>

            <!-- Slide 1 -->
            <div class="ticket-editor-card">
              <strong style="display:block; margin-bottom:10px; color:var(--primary);">Slide 1 (Konser / Event Utama):</strong>
              <div class="cms-grid-2">
                <div class="cms-form-group">
                  <label class="cms-label" for="slide1Tag">Badge Tagline</label>
                  <input type="text" id="slide1Tag" class="cms-input" value="Trending Festival 2026">
                </div>
                <div class="cms-form-group">
                  <label class="cms-label" for="slide1Img">URL Gambar Banner</label>
                  <input type="text" id="slide1Img" class="cms-input" value="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=1200&q=80">
                </div>
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide1Title">Judul Slide 1</label>
                <input type="text" id="slide1Title" class="cms-input" value="Soundwave Jakarta Fest 2026: Live Stage">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide1Desc">Deskripsi Slide 1</label>
                <textarea id="slide1Desc" class="cms-textarea" rows="2">Saksikan penampilan musisi papan atas Indonesia dan internasional secara langsung di GBK Senayan. Dapatkan tiket presale sekarang sebelum kehabisan!</textarea>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="ticket-editor-card">
              <strong style="display:block; margin-bottom:10px; color:var(--teal, #00A490);">Slide 2 (Wisata / Wahana):</strong>
              <div class="cms-grid-2">
                <div class="cms-form-group">
                  <label class="cms-label" for="slide2Tag">Badge Tagline</label>
                  <input type="text" id="slide2Tag" class="cms-input" value="Wisata & Liburan Seru">
                </div>
                <div class="cms-form-group">
                  <label class="cms-label" for="slide2Img">URL Gambar Banner</label>
                  <input type="text" id="slide2Img" class="cms-input" value="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=1200&q=80">
                </div>
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide2Title">Judul Slide 2</label>
                <input type="text" id="slide2Title" class="cms-input" value="Wisata Alam & Safari Adventure Park">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide2Desc">Deskripsi Slide 2</label>
                <textarea id="slide2Desc" class="cms-textarea" rows="2">Jelajahi keindahan alam liar dan nikmati atraksi keluarga tak terlupakan. Praktis tanpa antre dengan e-tiket instan Goers.</textarea>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="ticket-editor-card">
              <strong style="display:block; margin-bottom:10px; color:var(--purple, #7B1FA2);">Slide 3 (Crowd / Komunitas):</strong>
              <div class="cms-grid-2">
                <div class="cms-form-group">
                  <label class="cms-label" for="slide3Tag">Badge Tagline</label>
                  <input type="text" id="slide3Tag" class="cms-input" value="Fitur Baru Goers">
                </div>
                <div class="cms-form-group">
                  <label class="cms-label" for="slide3Img">URL Gambar Banner</label>
                  <input type="text" id="slide3Img" class="cms-input" value="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80">
                </div>
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide3Title">Judul Slide 3</label>
                <input type="text" id="slide3Title" class="cms-input" value="Bawa ke Crowd: Temukan Teman Sefrekuensi">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="slide3Desc">Deskripsi Slide 3</label>
                <textarea id="slide3Desc" class="cms-textarea" rows="2">Mau nonton konser atau nongkrong tapi bingung ajak siapa? Post rencana meetup kamu di Crowd dan jalan bareng!</textarea>
              </div>
            </div>
          </div>

          <!-- Section 3: Daftar Tiket Konser & Festival -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
              3. Daftar Tiket Konser & Festival Musik (Dapat Diubah Semua)
            </div>

            <div class="cms-grid-2">
              <div class="cms-form-group">
                <label class="cms-label" for="concertHeaderTitle">Judul Bagian Konser</label>
                <input type="text" id="concertHeaderTitle" class="cms-input" value="Konser Musik & Festival Paling Hits">
              </div>
              <div class="cms-form-group">
                <label class="cms-label" for="concertHeaderDesc">Sub-judul Bagian Konser</label>
                <input type="text" id="concertHeaderDesc" class="cms-input" value="Temukan tiket konser musisi favoritmu dengan harga terbaik dan konfirmasi instan">
              </div>
            </div>

            <div id="ticketsListContainer">
              <!-- Item Tiket 1 -->
              <div class="ticket-editor-card ticket-item">
                <strong style="color:var(--t-base);">Tiket Konser #1:</strong>
                <div class="cms-grid-2" style="margin-top:10px;">
                  <div class="cms-form-group">
                    <label class="cms-label">Nama Acara / Tiket</label>
                    <input type="text" class="cms-input t-name" value="Soundwave Jakarta Fest 2026: The Grand Stage">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Harga Tiket</label>
                    <input type="text" class="cms-input t-price" value="Rp 275.000">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Tanggal Pelaksanaan</label>
                    <input type="text" class="cms-input t-date" value="14 - 15 November 2026">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Lokasi Acara</label>
                    <input type="text" class="cms-input t-location" value="GBK Senayan, Jakarta Pusat">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">URL Foto Acara</label>
                    <input type="text" class="cms-input t-img" value="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Label Kategori</label>
                    <input type="text" class="cms-input t-category" value="Konser Musik">
                  </div>
                </div>
              </div>

              <!-- Item Tiket 2 -->
              <div class="ticket-editor-card ticket-item">
                <strong style="color:var(--t-base);">Tiket Konser #2:</strong>
                <div class="cms-grid-2" style="margin-top:10px;">
                  <div class="cms-form-group">
                    <label class="cms-label">Nama Acara / Tiket</label>
                    <input type="text" class="cms-input t-name" value="Indie Wave Music Night: Bandung Special Edition">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Harga Tiket</label>
                    <input type="text" class="cms-input t-price" value="Rp 120.000">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Tanggal Pelaksanaan</label>
                    <input type="text" class="cms-input t-date" value="28 November 2026">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Lokasi Acara</label>
                    <input type="text" class="cms-input t-location" value="Dago Tea House, Bandung">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">URL Foto Acara</label>
                    <input type="text" class="cms-input t-img" value="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=600&q=80">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Label Kategori</label>
                    <input type="text" class="cms-input t-category" value="Festival Musik">
                  </div>
                </div>
              </div>

              <!-- Item Tiket 3 -->
              <div class="ticket-editor-card ticket-item">
                <strong style="color:var(--t-base);">Tiket Konser #3:</strong>
                <div class="cms-grid-2" style="margin-top:10px;">
                  <div class="cms-form-group">
                    <label class="cms-label">Nama Acara / Tiket</label>
                    <input type="text" class="cms-input t-name" value="1st Community Orchestra Concert 'JELAJAH NUSA'">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Harga Tiket</label>
                    <input type="text" class="cms-input t-price" value="Rp 185.000">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Tanggal Pelaksanaan</label>
                    <input type="text" class="cms-input t-date" value="05 Desember 2026">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Lokasi Acara</label>
                    <input type="text" class="cms-input t-location" value="Teater Jakarta, TIM">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">URL Foto Acara</label>
                    <input type="text" class="cms-input t-img" value="https://images.unsplash.com/photo-1465847899084-d164df4dedc6?auto=format&fit=crop&w=600&q=80">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Label Kategori</label>
                    <input type="text" class="cms-input t-category" value="Orchestra">
                  </div>
                </div>
              </div>

              <!-- Item Tiket 4 -->
              <div class="ticket-editor-card ticket-item">
                <strong style="color:var(--t-base);">Tiket Konser #4:</strong>
                <div class="cms-grid-2" style="margin-top:10px;">
                  <div class="cms-form-group">
                    <label class="cms-label">Nama Acara / Tiket</label>
                    <input type="text" class="cms-input t-name" value="Retro 90s Revival: Sing Along Night Vol. 4">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Harga Tiket</label>
                    <input type="text" class="cms-input t-price" value="Rp 99.000">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Tanggal Pelaksanaan</label>
                    <input type="text" class="cms-input t-date" value="12 Desember 2026">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Lokasi Acara</label>
                    <input type="text" class="cms-input t-location" value="SCBD Park, Jakarta Selatan">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">URL Foto Acara</label>
                    <input type="text" class="cms-input t-img" value="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=600&q=80">
                  </div>
                  <div class="cms-form-group">
                    <label class="cms-label">Label Kategori</label>
                    <input type="text" class="cms-input t-category" value="Live Music">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Section 4: Fitur CROWD & Meetup -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              4. Section Fitur CROWD Meetup
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="crowdTitle">Judul Crowd (Mendukung HTML & Highlight Teks)</label>
              <input type="text" id="crowdTitle" class="cms-input" value="Jangan sampai rencana cuma jadi wacana. <span>Post, cari teman, langsung jalan!</span>">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="crowdDesc">Deskripsi Fitur Crowd</label>
              <textarea id="crowdDesc" class="cms-textarea" rows="3">Pergi sendirian itu valid. Tapi pergi bareng itu core memory! Crowd membantumu menemukan teman baru yang mau melakukan aktivitas seru di dunia nyata. Konser, nobar, kulineran, hingga jalan santai di museum.</textarea>
            </div>
          </div>

          <!-- Section 5: Bisnis & GEM Solution -->
          <div class="cms-card">
            <div class="cms-section-title">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7h-7L10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
              5. Section Solusi Bisnis & GEM (Goers Experience Manager)
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="gemTitle">Judul Solusi Bisnis</label>
              <input type="text" id="gemTitle" class="cms-input" value="Solusi Ticketing & Event Management End-to-End untuk Bisnis Anda">
            </div>

            <div class="cms-form-group">
              <label class="cms-label" for="gemDesc">Deskripsi Solusi Bisnis</label>
              <textarea id="gemDesc" class="cms-textarea" rows="3">GOERS menyediakan teknologi manajemen reservasi tiket online, POS kasir offline, access gate scanner, hingga laporan analitik real-time untuk event organizer dan pengelola destinasi wisata di Indonesia.</textarea>
            </div>
          </div>

          <!-- Floating Sticky Action Buttons -->
          <div class="cms-actions">
            <button class="btn btn--ghost" onclick="resetToDefault()">Kembalikan Default Template</button>
            <button class="btn btn--primary" onclick="saveFullCmsData()">Simpan & Publikasikan ke Landing Page</button>
          </div>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script>
    // Load saved settings
    document.addEventListener('DOMContentLoaded', () => {
      try {
        const raw = localStorage.getItem('goers_full_cms');
        if (raw) {
          const d = JSON.parse(raw);
          if (d.brandLogoText) document.getElementById('brandLogoText').value = d.brandLogoText;
          if (d.topBarText) document.getElementById('topBarText').value = d.topBarText;

          // Hero Slides
          if (d.slide1Tag) document.getElementById('slide1Tag').value = d.slide1Tag;
          if (d.slide1Img) document.getElementById('slide1Img').value = d.slide1Img;
          if (d.slide1Title) document.getElementById('slide1Title').value = d.slide1Title;
          if (d.slide1Desc) document.getElementById('slide1Desc').value = d.slide1Desc;

          if (d.slide2Tag) document.getElementById('slide2Tag').value = d.slide2Tag;
          if (d.slide2Img) document.getElementById('slide2Img').value = d.slide2Img;
          if (d.slide2Title) document.getElementById('slide2Title').value = d.slide2Title;
          if (d.slide2Desc) document.getElementById('slide2Desc').value = d.slide2Desc;

          if (d.slide3Tag) document.getElementById('slide3Tag').value = d.slide3Tag;
          if (d.slide3Img) document.getElementById('slide3Img').value = d.slide3Img;
          if (d.slide3Title) document.getElementById('slide3Title').value = d.slide3Title;
          if (d.slide3Desc) document.getElementById('slide3Desc').value = d.slide3Desc;

          // Concert Header
          if (d.concertHeaderTitle) document.getElementById('concertHeaderTitle').value = d.concertHeaderTitle;
          if (d.concertHeaderDesc) document.getElementById('concertHeaderDesc').value = d.concertHeaderDesc;

          // Crowd & GEM
          if (d.crowdTitle) document.getElementById('crowdTitle').value = d.crowdTitle;
          if (d.crowdDesc) document.getElementById('crowdDesc').value = d.crowdDesc;
          if (d.gemTitle) document.getElementById('gemTitle').value = d.gemTitle;
          if (d.gemDesc) document.getElementById('gemDesc').value = d.gemDesc;

          // Tickets List
          if (d.tickets && Array.isArray(d.tickets)) {
            const cards = document.querySelectorAll('.ticket-item');
            d.tickets.forEach((t, i) => {
              if (cards[i]) {
                if (t.name) cards[i].querySelector('.t-name').value = t.name;
                if (t.price) cards[i].querySelector('.t-price').value = t.price;
                if (t.date) cards[i].querySelector('.t-date').value = t.date;
                if (t.location) cards[i].querySelector('.t-location').value = t.location;
                if (t.img) cards[i].querySelector('.t-img').value = t.img;
                if (t.category) cards[i].querySelector('.t-category').value = t.category;
              }
            });
          }
        }
      } catch (err) {
        console.error('Error loading full CMS', err);
      }
    });

    function saveFullCmsData() {
      // Collect tickets
      const tickets = [];
      document.querySelectorAll('.ticket-item').forEach(card => {
        tickets.push({
          name: card.querySelector('.t-name').value,
          price: card.querySelector('.t-price').value,
          date: card.querySelector('.t-date').value,
          location: card.querySelector('.t-location').value,
          img: card.querySelector('.t-img').value,
          category: card.querySelector('.t-category').value,
        });
      });

      const fullData = {
        brandLogoText: document.getElementById('brandLogoText').value,
        topBarText: document.getElementById('topBarText').value,

        slide1Tag: document.getElementById('slide1Tag').value,
        slide1Img: document.getElementById('slide1Img').value,
        slide1Title: document.getElementById('slide1Title').value,
        slide1Desc: document.getElementById('slide1Desc').value,

        slide2Tag: document.getElementById('slide2Tag').value,
        slide2Img: document.getElementById('slide2Img').value,
        slide2Title: document.getElementById('slide2Title').value,
        slide2Desc: document.getElementById('slide2Desc').value,

        slide3Tag: document.getElementById('slide3Tag').value,
        slide3Img: document.getElementById('slide3Img').value,
        slide3Title: document.getElementById('slide3Title').value,
        slide3Desc: document.getElementById('slide3Desc').value,

        concertHeaderTitle: document.getElementById('concertHeaderTitle').value,
        concertHeaderDesc: document.getElementById('concertHeaderDesc').value,

        crowdTitle: document.getElementById('crowdTitle').value,
        crowdDesc: document.getElementById('crowdDesc').value,

        gemTitle: document.getElementById('gemTitle').value,
        gemDesc: document.getElementById('gemDesc').value,

        tickets: tickets
      };

      localStorage.setItem('goers_full_cms', JSON.stringify(fullData));

      const alertBox = document.getElementById('saveAlert');
      alertBox.style.display = 'block';
      setTimeout(() => { alertBox.style.display = 'none'; }, 5000);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetToDefault() {
      if (confirm('Kembalikan semua teks, banner, dan daftar tiket ke bawaan template awal?')) {
        localStorage.removeItem('goers_full_cms');
        location.reload();
      }
    }
  </script>
</body>
</html>
