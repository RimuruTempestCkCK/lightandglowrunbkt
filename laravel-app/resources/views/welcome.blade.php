<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GOERS | Beli Tiket Online Lebih Gampang dengan Respons Cepat</title>
  <meta name="description" content="Harga terbaik tiket tempat wisata, konser, & event seru lainnya menantimu di goersapp.com!" />
  <meta name="theme-color" content="#EB1355" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
  <link rel="alternate icon" href="{{ asset('favicon.ico') }}" />

  <!-- Google Fonts: Karla & Montserrat & Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,500;0,700;1,400&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- External Stylesheet -->
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <!-- Top Announcement Bar -->
  <div class="top-bar">
    <div class="goers-container" style="display:flex; justify-content:space-between; align-items:center; width:100%;">
      <div>
        <span id="cmsTopBar">⚡ Jelajah event musik, wisata & aktivitas terbaik. <strong>Diskon s/d 50%</strong></span> <a href="#konser-section">Beli Tiket Sekarang</a>
      </div>
      <div class="top-bar-right">
        <a href="#gem-section" class="top-bar-item">
          <i data-lucide="briefcase" style="width:14px; height:14px;"></i>
          Solusi Bisnis & GEM
        </a>
        <a href="#help-section" class="top-bar-item">
          <i data-lucide="help-circle" style="width:14px; height:14px;"></i>
          Pusat Bantuan
        </a>
        <div class="top-bar-item">
          <i data-lucide="globe" style="width:14px; height:14px;"></i>
          ID | IDR
        </div>
      </div>
    </div>
  </div>

  <!-- Main Sticky Header -->
  <header class="goers-header">
    <div class="goers-container">
      <div class="goers-nav-wrapper">
        <!-- Logo -->
        <a href="index.html" class="goers-brand-logo" id="cmsBrandLogoLink">
          <span id="cmsBrandLogoText">GOERS</span><span class="dot">.</span>
        </a>

        <!-- Desktop Search Bar -->
        <div class="goers-search-box">
          <i data-lucide="search" class="goers-search-icon" style="width:18px; height:18px;"></i>
          <input type="text" id="mainSearchInput" class="goers-search-input" placeholder="Cari konser, tempat wisata, atau event seru..." onkeyup="filterEvents(this.value)" />
        </div>

        <!-- Navigation Actions -->
        <div class="goers-nav-actions">
          <div class="nav-links-desktop" style="display:flex; align-items:center; gap:8px;">
            <a href="#konser-section" class="nav-btn-link">Konser</a>
            <a href="#wisata-section" class="nav-btn-link">Wisata</a>
            <a href="#crowd-section" class="nav-btn-link">
              Crowd
              <span class="badge-new">NEW</span>
            </a>
            <a href="{{ route('buyer.dashboard') }}" class="nav-btn-link" style="color:var(--goers-branding-500); font-weight:700;">
              <i data-lucide="ticket" style="width:14px;height:14px; vertical-align:middle;"></i>
              Tiket Saya
            </a>
          </div>

          <a href="{{ route('buyer.dashboard') }}" class="btn-login" style="border-color:var(--goers-branding-500); color:var(--goers-branding-500);">
            Tiket Saya
          </a>
          <a href="{{ route('login') }}" class="btn-signup">Admin Portal</a>
          
          <button class="mobile-menu-toggle" onclick="toggleMobileDrawer()">
            <i data-lucide="menu" style="width:24px; height:24px;"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Search Row -->
    <div class="mobile-search-row">
      <div class="goers-search-box" style="display:block; max-width:100%;">
        <i data-lucide="search" class="goers-search-icon" style="width:18px; height:18px;"></i>
        <input type="text" class="goers-search-input" placeholder="Cari konser, tempat wisata..." onkeyup="filterEvents(this.value)" />
      </div>
    </div>

    <!-- Categories Sub Navigation -->
    <nav class="goers-subnav">
      <div class="goers-container">
        <ul class="subnav-list">
          <li class="subnav-item active"><a href="#" onclick="selectCategory('all', event)"><i data-lucide="compass" style="width:16px;height:16px;"></i> Semua Acara</a></li>
          <li class="subnav-item"><a href="#konser-section" onclick="selectCategory('konser', event)"><i data-lucide="music" style="width:16px;height:16px;"></i> Konser Musik</a></li>
          <li class="subnav-item"><a href="#wisata-section" onclick="selectCategory('wisata', event)"><i data-lucide="map-pin" style="width:16px;height:16px;"></i> Tempat Wisata</a></li>
          <li class="subnav-item"><a href="#" onclick="selectCategory('olahraga', event)"><i data-lucide="trophy" style="width:16px;height:16px;"></i> Olahraga & Running</a></li>
          <li class="subnav-item"><a href="#" onclick="selectCategory('pameran', event)"><i data-lucide="image" style="width:16px;height:16px;"></i> Pameran & Art</a></li>
          <li class="subnav-item"><a href="#" onclick="selectCategory('workshop', event)"><i data-lucide="book-open" style="width:16px;height:16px;"></i> Kelas & Workshop</a></li>
          <li class="subnav-item"><a href="#crowd-section" onclick="selectCategory('crowd', event)"><i data-lucide="users" style="width:16px;height:16px;"></i> Crowd Meetup</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Mobile Drawer -->
  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleMobileDrawer()"></div>
  <div class="mobile-drawer" id="mobileDrawer">
    <div style="display:flex; justify-content:space-between; align-items:center;">
      <a href="index.html" class="goers-brand-logo">GOERS<span class="dot">.</span></a>
      <button onclick="toggleMobileDrawer()"><i data-lucide="x" style="width:24px;height:24px;"></i></button>
    </div>
    <div style="display:flex; flex-direction:column; gap:14px; margin-top:20px;">
      <a href="#konser-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">🎵 Konser Musik</a>
      <a href="#wisata-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">🎡 Tempat Wisata</a>
      <a href="#crowd-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">👥 Crowd Meetup <span class="badge-new">NEW</span></a>
      <a href="#gem-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">💼 Solusi Bisnis & GEM</a>
      <a href="#help-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">❓ Pusat Bantuan</a>
    </div>
    <div style="margin-top:auto; display:flex; flex-direction:column; gap:10px;">
      <a href="{{ route('buyer.dashboard') }}" class="btn-login" style="width:100%; text-align:center; display:block; border-color:var(--goers-branding-500); color:var(--goers-branding-500);">🎫 Tiket Saya & Riwayat</a>
      <a href="{{ route('login') }}" class="btn-signup" style="width:100%; text-align:center; display:block;">Admin Portal</a>
    </div>
  </div>

  <!-- Hero Banner Carousel -->
  <section class="goers-hero-section">
    <div class="goers-container">
      <div class="hero-slider-container">
        <!-- Slider Track -->
        <div class="hero-slider" id="heroSlider">
          
          <!-- Slide 1: Music Concert -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=1200&q=80" alt="Hero Slide 1" id="cmsSlide1Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide1Tag">Trending Festival 2026</span>
              <h1 class="hero-title" id="cmsSlide1Title">Soundwave Jakarta Fest 2026: Live Stage</h1>
              <p class="hero-desc" id="cmsSlide1Desc">Saksikan penampilan musisi papan atas Indonesia dan internasional secara langsung di GBK Senayan. Dapatkan tiket presale sekarang sebelum kehabisan!</p>
              <button class="btn-hero-action" onclick="showTicketDetail('Soundwave Jakarta Fest 2026', 'Rp 275.000', '14 - 15 Nov 2026', 'Stadion Utama GBK, Jakarta', 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=1200&q=80', 'Konser Musik')">
                <i data-lucide="ticket" style="width:18px;height:18px;"></i>
                Beli Tiket Presale
              </button>
            </div>
          </div>

          <!-- Slide 2: Tourism & Theme Park -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=1200&q=80" alt="Hero Slide 2" id="cmsSlide2Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide2Tag" style="background:var(--goers-teal);">Wisata & Liburan Seru</span>
              <h1 class="hero-title" id="cmsSlide2Title">Wisata Alam & Safari Adventure Park</h1>
              <p class="hero-desc" id="cmsSlide2Desc">Jelajahi keindahan alam liar dan nikmati atraksi keluarga tak terlupakan. Praktis tanpa antre dengan e-tiket instan Goers.</p>
              <button class="btn-hero-action" style="background:var(--goers-teal);" onclick="showTicketDetail('Wisata Alam & Safari Adventure', 'Rp 95.000', 'Buka Setiap Hari (08:00 - 17:00)', 'Bogor, Jawa Barat', 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=1200&q=80', 'Tempat Wisata')">
                <i data-lucide="compass" style="width:18px;height:18px;"></i>
                Pesan Tiket Wisata
              </button>
            </div>
          </div>

          <!-- Slide 3: Crowd Meetup -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80" alt="Hero Slide 3" id="cmsSlide3Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide3Tag" style="background:#7B1FA2;">Fitur Baru Goers</span>
              <h1 class="hero-title" id="cmsSlide3Title">Bawa ke Crowd: Temukan Teman Sefrekuensi</h1>
              <p class="hero-desc" id="cmsSlide3Desc">Mau nonton konser atau nongkrong tapi bingung ajak siapa? Post rencana meetup kamu di Crowd dan jalan bareng!</p>
              <a href="#crowd-section" class="btn-hero-action" style="background:#7B1FA2;">
                <i data-lucide="users" style="width:18px;height:18px;"></i>
                Jelajahi Crowd Meetup
              </a>
            </div>
          </div>

        </div>

        <!-- Slider Navigation -->
        <button class="slider-arrow prev" onclick="slideHero(-1)"><i data-lucide="chevron-left" style="width:24px;height:24px;"></i></button>
        <button class="slider-arrow next" onclick="slideHero(1)"><i data-lucide="chevron-right" style="width:24px;height:24px;"></i></button>

        <!-- Slider Dots -->
        <div class="slider-dots" id="sliderDots">
          <div class="slider-dot active" onclick="goToSlide(0)"></div>
          <div class="slider-dot" onclick="goToSlide(1)"></div>
          <div class="slider-dot" onclick="goToSlide(2)"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Category Shortcut Grid -->
  <section class="goers-categories-bar">
    <div class="goers-container">
      <div class="category-grid">
        <div class="category-card" onclick="filterByCategory('konser')">
          <div class="category-icon-wrapper cat-concert">
            <i data-lucide="music-2"></i>
          </div>
          <span class="category-name">Konser & Musik</span>
        </div>

        <div class="category-card" onclick="filterByCategory('wisata')">
          <div class="category-icon-wrapper cat-attraction">
            <i data-lucide="ferris-wheel"></i>
          </div>
          <span class="category-name">Tempat Wisata</span>
        </div>

        <div class="category-card" onclick="filterByCategory('olahraga')">
          <div class="category-icon-wrapper cat-sport">
            <i data-lucide="activity"></i>
          </div>
          <span class="category-name">Olahraga & Run</span>
        </div>

        <div class="category-card" onclick="filterByCategory('travel')">
          <div class="category-icon-wrapper cat-travel">
            <i data-lucide="plane"></i>
          </div>
          <span class="category-name">Travel & Tour</span>
        </div>

        <div class="category-card" onclick="filterByCategory('pameran')">
          <div class="category-icon-wrapper cat-exhibition">
            <i data-lucide="palette"></i>
          </div>
          <span class="category-name">Pameran & Seni</span>
        </div>

        <div class="category-card" onclick="location.href='#crowd-section'">
          <div class="category-icon-wrapper cat-meetup">
            <i data-lucide="users"></i>
          </div>
          <span class="category-name">Crowd Meetup</span>
        </div>

        <div class="category-card" onclick="filterByCategory('workshop')">
          <div class="category-icon-wrapper cat-workshop">
            <i data-lucide="graduation-cap"></i>
          </div>
          <span class="category-name">Workshop Edu</span>
        </div>

        <div class="category-card" onclick="filterByCategory('all')">
          <div class="category-icon-wrapper cat-more">
            <i data-lucide="grid"></i>
          </div>
          <span class="category-name">Semua Kategori</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 1: Populer & Trending Tiket Konser -->
  <section class="section-wrap" id="konser-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="flame" style="width:14px;height:14px;"></i> Tiket Pilihan Terpopuler</span>
          <h2 class="section-title" id="cmsConcertTitle">Konser Musik & Festival Paling Hits</h2>
          <p class="section-subtitle" id="cmsConcertDesc">Temukan tiket konser musisi favoritmu dengan harga terbaik dan konfirmasi instan</p>
        </div>
        <a href="#all" class="btn-view-all">Lihat Semua <i data-lucide="arrow-right" style="width:16px;height:16px;"></i></a>
      </div>

      <div class="event-grid" id="eventsContainer">
        <!-- Event Card 1 -->
        <div class="event-card" data-category="konser" data-name="Soundwave Jakarta Fest 2026">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Konser Musik</span>
            <span class="event-badge-sale">Best Seller</span>
            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80" alt="Soundwave Jakarta Fest" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                14 - 15 November 2026
              </div>
              <h3 class="event-name">Soundwave Jakarta Fest 2026: The Grand Stage</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                GBK Senayan, Jakarta Pusat
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 275.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Soundwave Jakarta Fest 2026: The Grand Stage', 'Rp 275.000', '14 - 15 Nov 2026', 'GBK Senayan, Jakarta Pusat', 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80', 'Konser Musik')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 2 -->
        <div class="event-card" data-category="konser" data-name="Indie Wave Fest Bandung">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Festival</span>
            <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=600&q=80" alt="Indie Wave Fest" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                28 November 2026
              </div>
              <h3 class="event-name">Indie Wave Music Night: Bandung Special Edition</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Dago Tea House, Bandung
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 120.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Indie Wave Music Night: Bandung Special Edition', 'Rp 120.000', '28 Nov 2026', 'Dago Tea House, Bandung', 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=600&q=80', 'Konser Musik')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 3 -->
        <div class="event-card" data-category="konser" data-name="Symphony Orchestra Concert Jelajah">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Orchestra</span>
            <img src="https://images.unsplash.com/photo-1465847899084-d164df4dedc6?auto=format&fit=crop&w=600&q=80" alt="Symphony Orchestra" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                05 Desember 2026
              </div>
              <h3 class="event-name">1st Community Orchestra Concert 'JELAJAH NUSA'</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Teater Jakarta, TIM
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 185.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('1st Community Orchestra Concert JELAJAH NUSA', 'Rp 185.000', '05 Des 2026', 'Teater Jakarta, TIM', 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?auto=format&fit=crop&w=600&q=80', 'Orchestra')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 4 -->
        <div class="event-card" data-category="konser" data-name="Retro 90s Revival Night">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Live Music</span>
            <span class="event-badge-sale">Promo 20%</span>
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=600&q=80" alt="Retro 90s Night" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                12 Desember 2026
              </div>
              <h3 class="event-name">Retro 90s Revival: Sing Along Night Vol. 4</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                SCBD Park, Jakarta Selatan
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 99.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Retro 90s Revival: Sing Along Night Vol. 4', 'Rp 99.000', '12 Des 2026', 'SCBD Park, Jakarta Selatan', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=600&q=80', 'Konser Musik')">Beli Tiket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 2: CROWD (Goers Key Innovation Feature) -->
  <div class="goers-container" id="crowd-section">
    <section class="goers-crowd-section">
      <div class="crowd-shapes"></div>
      <div class="goers-container">
        <div class="crowd-layout">
          <!-- Left: Copy & Explanation -->
          <div>
            <div class="crowd-tag">
              <i data-lucide="sparkles" style="width:14px;height:14px;"></i>
              Kenalin CROWD di Goers
            </div>
            <h2 class="crowd-title" id="cmsCrowdTitle">
              Jangan sampai rencana cuma jadi wacana. <span>Post, cari teman, langsung jalan!</span>
            </h2>
            <p class="crowd-description" id="cmsCrowdDesc">
              Pergi sendirian itu valid. Tapi pergi bareng itu core memory! Crowd membantumu menemukan teman baru yang mau melakukan aktivitas seru di dunia nyata. Konser, nobar, kulineran, hingga jalan santai di museum.
            </p>

            <div class="crowd-chips">
              <span class="crowd-chip">🎵 Konser</span>
              <span class="crowd-chip">☕ Ngopi Santai</span>
              <span class="crowd-chip">🏃 Lari & Padel</span>
              <span class="crowd-chip">🎨 Jelajah Museum</span>
              <span class="crowd-chip">🍿 Nobar Film</span>
              <span class="crowd-chip">🍕 Kuliner Malam</span>
            </div>

            <div class="crowd-cta-row">
              <a href="https://play.google.com/store/apps/details?id=com.goersapp.goers" target="_blank" class="btn-crowd-app">
                <i data-lucide="smartphone" style="width:18px;height:18px;"></i>
                Buka Crowd di Aplikasi Goers
              </a>
              <span style="font-size:12px; color:#ADC9F4;">*Tersedia gratis di iOS & Android</span>
            </div>
          </div>

          <!-- Right: Interactive Live Meetup Demo Card -->
          <div>
            <div class="crowd-preview-card">
              <div class="crowd-meetup-header">
                <div class="crowd-avatar">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Sarah Host" />
                </div>
                <div class="crowd-author-info">
                  <h4>Sarah Amanda (Host)</h4>
                  <span>Baru saja membuat meetup di Crowd</span>
                </div>
              </div>

              <div class="crowd-meetup-body">
                <div class="meetup-title">🎸 Nobar & Sing-Along Soundwave Jakarta Fest 2026</div>
                <p style="font-size:13px; color:#D5E4F9; margin-bottom:12px;">
                  "Cari 3 temen lagi yang suka musisi indie buat nonton Day-2 bareng biar ada yang barengan nyanyi & foto-foto!"
                </p>
                <div class="meetup-meta">
                  <div class="meetup-meta-item">
                    <i data-lucide="map-pin" style="width:14px;height:14px; color:#F15A88;"></i>
                    GBK Senayan Gate 5
                  </div>
                  <div class="meetup-meta-item">
                    <i data-lucide="clock" style="width:14px;height:14px; color:#F15A88;"></i>
                    Sabtu, 16:00 WIB
                  </div>
                  <div class="meetup-meta-item">
                    <i data-lucide="users" style="width:14px;height:14px; color:#F15A88;"></i>
                    Maks. 5 Orang
                  </div>
                </div>
              </div>

              <div class="crowd-participants-row">
                <div style="display:flex; align-items:center; gap:8px;">
                  <div class="participants-avatars">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=100&q=80" alt="User 1" />
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="User 2" />
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="User 3" />
                    <div class="more-count">+2</div>
                  </div>
                  <span style="font-size:12px; color:#ADC9F4;">3/5 Slot Terisi</span>
                </div>

                <button class="btn-buy-ticket" style="background:var(--goers-branding-500); padding:8px 18px;" onclick="openLoginModal('Gabung Meetup')">
                  Gabung Meetup
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Section 3: Tempat Wisata & Destinasi Liburan -->
  <section class="section-wrap" id="wisata-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge" style="color:var(--goers-teal);"><i data-lucide="palmtree" style="width:14px;height:14px;"></i> Destinasi Favorit</span>
          <h2 class="section-title">Tempat Wisata & Liburan Seru</h2>
          <p class="section-subtitle">Beli tiket masuk wisata, waterpark, dan wahana atraksi langsung tanpa antre</p>
        </div>
        <a href="#all" class="btn-view-all" style="color:var(--goers-teal);">Lihat Semua <i data-lucide="arrow-right" style="width:16px;height:16px;"></i></a>
      </div>

      <div class="event-grid">
        <!-- Wisata Card 1 -->
        <div class="event-card" data-category="wisata" data-name="Taman Safari & Wild Adventure">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Wisata Alam</span>
            <img src="https://images.unsplash.com/photo-1534567153574-2b12153a87f0?auto=format&fit=crop&w=600&q=80" alt="Safari Wild" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Setiap Hari (08:30 - 17:00)
              </div>
              <h3 class="event-name">Taman Safari Wild Life Experience & Animal Show</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Cisarua, Bogor
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Tiket Terusan</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 150.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Taman Safari Wild Life Experience & Animal Show', 'Rp 150.000', 'Buka Setiap Hari', 'Cisarua, Bogor', 'https://images.unsplash.com/photo-1534567153574-2b12153a87f0?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 2 -->
        <div class="event-card" data-category="wisata" data-name="Ocean Blue Marine Park">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Akuarium</span>
            <span class="event-badge-sale">Promo Family</span>
            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" alt="Ocean Aquarium" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Setiap Hari (10:00 - 21:00)
              </div>
              <h3 class="event-name">Ocean Blue Underwater World & Marine Tunnel</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Ancol, Jakarta Utara
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 115.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Ocean Blue Underwater World & Marine Tunnel', 'Rp 115.000', 'Setiap Hari', 'Ancol, Jakarta Utara', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 3 -->
        <div class="event-card" data-category="wisata" data-name="NuArt Sculpture Park Bandung">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Galeri Seni</span>
            <img src="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=600&q=80" alt="NuArt Sculpture Park" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Rabu - Minggu (09:00 - 17:00)
              </div>
              <h3 class="event-name">Jelajah Museum Seni NuArt Sculpture Park</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Setraduta, Bandung
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Tiket Masuk</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 50.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Jelajah Museum Seni NuArt Sculpture Park', 'Rp 50.000', 'Rabu - Minggu', 'Setraduta, Bandung', 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=600&q=80', 'Wisata Seni')">Pesan Tiket</button>
            </div>
          </div>
        </div>

        <!-- Wisata Card 4 -->
        <div class="event-card" data-category="wisata" data-name="Puncak Tea Garden Tour">
          <div class="event-thumbnail">
            <span class="event-badge-floating" style="background:var(--goers-teal);">Ekowisata</span>
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Tea Garden Tour" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row" style="color:var(--goers-teal);">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Buka Tiap Weekend
              </div>
              <h3 class="event-name">Sunrise Walk & Tea Walk Experience Gunung Mas</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Puncak, Jawa Barat
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value" style="color:var(--goers-teal);">Rp 35.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Sunrise Walk & Tea Walk Gunung Mas', 'Rp 35.000', 'Weekend', 'Puncak, Jawa Barat', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80', 'Tempat Wisata')">Pesan Tiket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 4: Kota & Destinasi Populer -->
  <section class="section-wrap">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="map" style="width:14px;height:14px;"></i> Jelajah Lokasi</span>
          <h2 class="section-title">Temukan Acara Berdasarkan Kota</h2>
          <p class="section-subtitle">Cari rekomendasi aktivitas dan hiburan di kota terdekatmu</p>
        </div>
      </div>

      <div class="destination-grid">
        <div class="destination-card" onclick="filterByCity('Jakarta')">
          <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80" alt="Jakarta" />
          <div class="destination-overlay">
            <div class="destination-city">Jakarta</div>
            <div class="destination-count">120+ Acara Aktif</div>
          </div>
        </div>

        <div class="destination-card" onclick="filterByCity('Bandung')">
          <img src="https://images.unsplash.com/photo-1549488344-1f9b8d2bd1f3?auto=format&fit=crop&w=400&q=80" alt="Bandung" />
          <div class="destination-overlay">
            <div class="destination-city">Bandung</div>
            <div class="destination-count">65+ Acara Aktif</div>
          </div>
        </div>

        <div class="destination-card" onclick="filterByCity('Yogyakarta')">
          <img src="https://images.unsplash.com/photo-1584810359583-96fc3448beaa?auto=format&fit=crop&w=400&q=80" alt="Yogyakarta" />
          <div class="destination-overlay">
            <div class="destination-city">Yogyakarta</div>
            <div class="destination-count">48+ Acara Aktif</div>
          </div>
        </div>

        <div class="destination-card" onclick="filterByCity('Bali')">
          <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=400&q=80" alt="Bali" />
          <div class="destination-overlay">
            <div class="destination-city">Bali</div>
            <div class="destination-count">80+ Acara Aktif</div>
          </div>
        </div>

        <div class="destination-card" onclick="filterByCity('Surabaya')">
          <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=400&q=80" alt="Surabaya" />
          <div class="destination-overlay">
            <div class="destination-city">Surabaya</div>
            <div class="destination-count">34+ Acara Aktif</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 5: GEM (Goers Experience Manager) Business Solution -->
  <section class="goers-container" id="gem-section">
    <div class="goers-gem-section">
      <div>
        <div class="gem-tag">Goers Experience Manager (GEM)</div>
        <h2 class="gem-title" id="cmsGemTitle">Solusi Ticketing & Event Management End-to-End untuk Bisnis Anda</h2>
        <p class="gem-desc" id="cmsGemDesc">
          GOERS menyediakan teknologi manajemen reservasi tiket online, POS kasir offline, access gate scanner, hingga laporan analitik real-time untuk event organizer dan pengelola destinasi wisata di Indonesia.
        </p>

        <ul class="gem-features-list">
          <li class="gem-feature-item"><i data-lucide="check-circle-2" style="width:18px;height:18px;"></i> Sistem Registrasi & Penjualan Tiket Online</li>
          <li class="gem-feature-item"><i data-lucide="check-circle-2" style="width:18px;height:18px;"></i> POS Kasir On-site & Gate Access Control</li>
          <li class="gem-feature-item"><i data-lucide="check-circle-2" style="width:18px;height:18px;"></i> QR Code Scanner Cepat Anti-Pemalsuan</li>
          <li class="gem-feature-item"><i data-lucide="check-circle-2" style="width:18px;height:18px;"></i> Dashboard Analitik Penjualan Realtime</li>
        </ul>

        <a href="https://www.goersapp.com/gem" target="_blank" class="btn-gem-partner">
          <i data-lucide="handshake" style="width:18px;height:18px;"></i>
          Pelajari Solusi Bisnis GEM
        </a>
      </div>

      <div class="gem-illu">
        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=80" alt="Goers Business Solution" />
      </div>
    </div>
  </section>

  <!-- Section 6: App Download Banner -->
  <section class="goers-container">
    <div class="goers-app-download">
      <div class="download-text">
        <h3>Pengalaman Lebih Mudah dengan Aplikasi GOERS</h3>
        <p>Beli tiket lebih cepat, dapatkan notifikasi promo eksklusif, dan buat meetup di fitur Crowd!</p>
      </div>

      <div class="download-badges">
        <a href="https://play.google.com/store/apps/details?id=com.goersapp.goers" target="_blank" class="store-badge">
          <i data-lucide="play" style="width:24px;height:24px; fill:#fff;"></i>
          <div class="store-text">
            <span>GET IT ON</span>
            <strong>Google Play</strong>
          </div>
        </a>

        <a href="https://apps.apple.com" target="_blank" class="store-badge">
          <i data-lucide="apple" style="width:24px;height:24px;"></i>
          <div class="store-text">
            <span>Download on the</span>
            <strong>App Store</strong>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="goers-footer" id="help-section">
    <div class="goers-container">
      <div class="footer-top-grid">
        <!-- Brand & Description -->
        <div class="footer-brand">
          <h2>GOERS<span>.</span></h2>
          <p>
            GOERS adalah platform terdepan yang menghubungkan orang dengan beragam pengalaman seru. Kami memberikan solusi teknologi untuk experience creators (event organizer dan venue wisata) serta kemudahan pembelian tiket online dan fitur Crowd meetup untuk pengguna.
          </p>
          <div class="social-links">
            <a href="https://instagram.com/goersapp" target="_blank" class="social-icon-btn"><i data-lucide="instagram" style="width:16px;height:16px;"></i></a>
            <a href="https://facebook.com/goersapp" target="_blank" class="social-icon-btn"><i data-lucide="facebook" style="width:16px;height:16px;"></i></a>
            <a href="https://twitter.com/goersapp" target="_blank" class="social-icon-btn"><i data-lucide="twitter" style="width:16px;height:16px;"></i></a>
            <a href="https://linkedin.com/company/goers" target="_blank" class="social-icon-btn"><i data-lucide="linkedin" style="width:16px;height:16px;"></i></a>
          </div>
        </div>

        <!-- Col 1 -->
        <div class="footer-col">
          <h4>Jelajah</h4>
          <ul class="footer-links">
            <li><a href="#konser-section">Konser Musik</a></li>
            <li><a href="#wisata-section">Tempat Wisata</a></li>
            <li><a href="#crowd-section">Crowd Meetup</a></li>
            <li><a href="#eventsContainer">Event Terdekat</a></li>
            <li><a href="#eventsContainer">Pameran & Seni</a></li>
          </ul>
        </div>

        <!-- Col 2 -->
        <div class="footer-col">
          <h4>Tentang Kami</h4>
          <ul class="footer-links">
            <li><a href="#">Tentang GOERS</a></li>
            <li><a href="#gem-section">Solusi Bisnis (GEM)</a></li>
            <li><a href="#">Karir & Budaya</a></li>
            <li><a href="#">Blog & Berita</a></li>
            <li><a href="#">Pedoman Komunitas</a></li>
          </ul>
        </div>

        <!-- Col 3 -->
        <div class="footer-col">
          <h4>Bantuan & Privasi</h4>
          <ul class="footer-links">
            <li><a href="#">Pusat Bantuan</a></li>
            <li><a href="#">Hubungi Customer Care</a></li>
            <li><a href="#">Syarat dan Ketentuan</a></li>
            <li><a href="#">Kebijakan Privasi</a></li>
            <li><a href="#">Kebijakan Cookie</a></li>
          </ul>
        </div>

        <!-- Col 4: Newsletter -->
        <div class="footer-col">
          <h4>Berlangganan Promo</h4>
          <p style="font-size:12px; margin-bottom:12px; color:#9CA3AF;">Dapatkan kabar promo tiket murah & jadwal konser terkini langsung ke emailmu.</p>
          <form class="newsletter-form" onsubmit="handleSubscribe(event)">
            <div class="newsletter-input-group">
              <input type="email" required placeholder="Alamat email Anda..." class="newsletter-input" />
              <button type="submit" class="btn-newsletter">Kirim</button>
            </div>
            <span id="subSuccess" style="color:#10B981; font-size:12px; display:none;">Terima kasih telah berlangganan!</span>
          </form>
        </div>
      </div>

      {{--
      <!-- Payment Methods -->
      <div class="footer-payments">
        <div class="payment-title">Metode Pembayaran Resmi & Terverifikasi:</div>
        <div class="payment-icons">
          <span class="payment-badge">BCA Virtual Account</span>
          <span class="payment-badge">Mandiri Livin</span>
          <span class="payment-badge">BNI Virtual Account</span>
          <span class="payment-badge">BRI BRIVA</span>
          <span class="payment-badge">GoPay</span>
          <span class="payment-badge">OVO</span>
          <span class="payment-badge">ShopeePay</span>
          <span class="payment-badge">DANA</span>
          <span class="payment-badge">QRIS</span>
          <span class="payment-badge">Kartu Kredit / Visa / Mastercard</span>
        </div>
      </div>
      --}}

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div>
          &copy; 2021-2026 PT Goers Expresi Solusi (GOERS). All Rights Reserved.
        </div>
        <div style="display:flex; gap:16px;">
          <a href="#" style="color:#9CA3AF;">Kebijakan Privasi</a>
          <span>•</span>
          <a href="#" style="color:#9CA3AF;">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Cookie Banner -->
  <div class="cookie-banner" id="cookieBanner">
    <div class="cookie-text">
      Kami menggunakan cookies untuk mempermudah pengalaman Anda di website GOERS. Baca <a href="#">Kebijakan Privasi</a> kami.
    </div>
    <button class="btn-cookie-accept" onclick="acceptCookies()">Saya Setuju</button>
  </div>

  <!-- Ticket Detail & Booking Modal -->
  <div class="modal-overlay" id="ticketModal" onclick="closeModalOnOverlay(event)">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Detail Event</h3>
        <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
      </div>
      <div class="modal-body">
        <img id="modalImg" class="modal-image" src="" alt="Event Detail" />
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
          <span id="modalCategory" style="background:var(--goers-branding-100); color:var(--goers-branding-500); font-weight:800; font-size:12px; padding:4px 10px; border-radius:4px;">Kategori</span>
          <span id="modalDate" style="font-size:13px; font-weight:700; color:var(--goers-navy-900);">Tanggal</span>
        </div>
        <h2 id="modalEventName" style="font-size:20px; font-weight:800; color:var(--goers-navy-900); margin-bottom:10px;">Nama Acara</h2>
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:var(--goers-gray-700); margin-bottom:16px;">
          <i data-lucide="map-pin" style="width:16px;height:16px;"></i>
          <span id="modalLocation">Lokasi Event</span>
        </div>
        <div style="border-top:1px solid var(--goers-gray-300); padding-top:14px;">
          <h4 style="font-size:14px; font-weight:700; margin-bottom:6px;">Tentang Tiket & Event:</h4>
          <p style="font-size:13px; color:var(--goers-gray-800); line-height:1.6;">
            E-tiket akan dikirimkan langsung ke email Anda setelah pembayaran terkonfirmasi. Tunjukkan barcode e-tiket saat masuk ke venue acara tanpa perlu cetak tiket fisik.
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <div>
          <span style="font-size:11px; color:var(--goers-gray-700);">Harga Total</span>
          <div id="modalPrice" style="font-size:20px; font-weight:800; color:var(--goers-branding-500);">Rp 0</div>
        </div>
        <button class="btn-signup" style="padding:10px 24px;" onclick="proceedCheckout()">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- External JavaScript Logic -->
  <script src="{{ asset('script.js') }}"></script>

  
  <!-- Full CMS Dynamic Hydration Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      try {
        const raw = localStorage.getItem('goers_full_cms');
        if (!raw) return;
        const d = JSON.parse(raw);

        // Brand & Top Bar
        if (d.brandLogoText) {
          const el = document.getElementById('cmsBrandLogoText');
          if (el) el.textContent = d.brandLogoText;
        }
        if (d.topBarText) {
          const el = document.getElementById('cmsTopBar');
          if (el) el.innerHTML = d.topBarText;
        }

        // Hero Slide 1
        if (d.slide1Tag) { const el = document.getElementById('cmsSlide1Tag'); if (el) el.textContent = d.slide1Tag; }
        if (d.slide1Img) { const el = document.getElementById('cmsSlide1Img'); if (el) el.src = d.slide1Img; }
        if (d.slide1Title) { const el = document.getElementById('cmsSlide1Title'); if (el) el.textContent = d.slide1Title; }
        if (d.slide1Desc) { const el = document.getElementById('cmsSlide1Desc'); if (el) el.textContent = d.slide1Desc; }

        // Hero Slide 2
        if (d.slide2Tag) { const el = document.getElementById('cmsSlide2Tag'); if (el) el.textContent = d.slide2Tag; }
        if (d.slide2Img) { const el = document.getElementById('cmsSlide2Img'); if (el) el.src = d.slide2Img; }
        if (d.slide2Title) { const el = document.getElementById('cmsSlide2Title'); if (el) el.textContent = d.slide2Title; }
        if (d.slide2Desc) { const el = document.getElementById('cmsSlide2Desc'); if (el) el.textContent = d.slide2Desc; }

        // Hero Slide 3
        if (d.slide3Tag) { const el = document.getElementById('cmsSlide3Tag'); if (el) el.textContent = d.slide3Tag; }
        if (d.slide3Img) { const el = document.getElementById('cmsSlide3Img'); if (el) el.src = d.slide3Img; }
        if (d.slide3Title) { const el = document.getElementById('cmsSlide3Title'); if (el) el.textContent = d.slide3Title; }
        if (d.slide3Desc) { const el = document.getElementById('cmsSlide3Desc'); if (el) el.textContent = d.slide3Desc; }

        // Concert Headers
        if (d.concertHeaderTitle) { const el = document.getElementById('cmsConcertTitle'); if (el) el.textContent = d.concertHeaderTitle; }
        if (d.concertHeaderDesc) { const el = document.getElementById('cmsConcertDesc'); if (el) el.textContent = d.concertHeaderDesc; }

        // Crowd & GEM
        if (d.crowdTitle) { const el = document.getElementById('cmsCrowdTitle'); if (el) el.innerHTML = d.crowdTitle; }
        if (d.crowdDesc) { const el = document.getElementById('cmsCrowdDesc'); if (el) el.textContent = d.crowdDesc; }
        if (d.gemTitle) { const el = document.getElementById('cmsGemTitle'); if (el) el.textContent = d.gemTitle; }
        if (d.gemDesc) { const el = document.getElementById('cmsGemDesc'); if (el) el.textContent = d.gemDesc; }

        // Update Concert Tickets (Dynamic Render & Support New Added Tickets)
        if (d.tickets && Array.isArray(d.tickets) && d.tickets.length > 0) {
          const container = document.getElementById('eventsContainer');
          if (container) {
            container.innerHTML = '';
            d.tickets.forEach((t) => {
              const card = document.createElement('div');
              card.className = 'event-card';
              card.setAttribute('data-category', 'konser');
              card.setAttribute('data-name', t.name || 'Tiket Light & Glow');

              card.innerHTML = `
                <div class="event-thumbnail">
                  <span class="event-badge-floating">${t.category || 'Konser Musik'}</span>
                  <img src="${t.img || 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80'}" alt="${t.name || 'Tiket'}" loading="lazy" />
                </div>
                <div class="event-body">
                  <div>
                    <div class="event-date-row">
                      <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                      ${t.date || '25 April 2026'}
                    </div>
                    <h3 class="event-name">${t.name || 'Tiket Konser'}</h3>
                    <div class="event-location-row">
                      <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                      ${t.location || 'Jam Gadang, Bukittinggi'}
                    </div>
                  </div>
                  <div class="event-footer">
                    <div>
                      <span class="price-label">Mulai dari</span>
                      <div class="price-value">${t.price || 'Rp 0'}</div>
                    </div>
                    <button class="btn-buy-ticket">Beli Tiket</button>
                  </div>
                </div>
              `;

              const btn = card.querySelector('.btn-buy-ticket');
              if (btn) {
                btn.onclick = function() {
                  showTicketDetail(t.name, t.price, t.date, t.location, t.img, t.category);
                };
              }
              container.appendChild(card);
            });
            if (window.lucide) lucide.createIcons();
          }
        }
      } catch (e) {
        console.error('Error synchronizing CMS to landing page', e);
      }
    });
  </script>
</body>
