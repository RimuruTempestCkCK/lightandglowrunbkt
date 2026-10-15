<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Light and Glow Bukittinggi 2026 | Tiket Resmi Lari Malam & Konser</title>
  <meta name="description" content="Dapatkan tiket resmi Light and Glow Bukittinggi 2026. Lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser musik spektakuler di Jam Gadang!" />
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
        <span id="cmsTopBar">⚡ Registrasi <strong>Light and Glow Bukittinggi 2026</strong> Resmi Dibuka! Kuota terbatas.</span> <a href="#tiket-section">Beli Tiket Sekarang</a>
      </div>
      <div class="top-bar-right">
        <a href="#help-section" class="top-bar-item">
          <i data-lucide="help-circle" style="width:14px; height:14px;"></i>
          Informasi Acara
        </a>
        <div class="top-bar-item">
          <i data-lucide="map-pin" style="width:14px; height:14px;"></i>
          Jam Gadang, Bukittinggi
        </div>
      </div>
    </div>
  </div>

  <!-- Main Sticky Header -->
  <header class="goers-header">
    <div class="goers-container">
      <div class="goers-nav-wrapper">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="goers-brand-logo" id="cmsBrandLogoLink">
          <span id="cmsBrandLogoText">LIGHT & GLOW</span><span class="dot">.</span>
        </a>

        <!-- Desktop Search Bar -->
        <div class="goers-search-box">
          <i data-lucide="search" class="goers-search-icon" style="width:18px; height:18px;"></i>
          <input type="text" id="mainSearchInput" class="goers-search-input" placeholder="Cari kategori tiket Light and Glow..." onkeyup="filterEvents(this.value)" />
        </div>

        <!-- Navigation Actions -->
        <div class="goers-nav-actions">
          <div class="nav-links-desktop" style="display:flex; align-items:center; gap:12px;">
            <a href="#tiket-section" class="nav-btn-link">Tiket</a>
            <a href="#highlight-section" class="nav-btn-link">Highlight Acara</a>
            <a href="#rute-section" class="nav-btn-link">Rute & Venue</a>
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
        <input type="text" class="goers-search-input" placeholder="Cari tiket Light and Glow..." onkeyup="filterEvents(this.value)" />
      </div>
    </div>
  </header>

  <!-- Mobile Drawer -->
  <div class="drawer-overlay" id="drawerOverlay" onclick="toggleMobileDrawer()"></div>
  <div class="mobile-drawer" id="mobileDrawer">
    <div style="display:flex; justify-content:space-between; align-items:center;">
      <a href="{{ route('home') }}" class="goers-brand-logo">LIGHT & GLOW<span class="dot">.</span></a>
      <button onclick="toggleMobileDrawer()"><i data-lucide="x" style="width:24px;height:24px;"></i></button>
    </div>
    <div style="display:flex; flex-direction:column; gap:14px; margin-top:20px;">
      <a href="#tiket-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">🎟️ Kategori Tiket</a>
      <a href="#highlight-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">✨ Highlight Acara</a>
      <a href="#rute-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">📍 Rute & Venue</a>
      <a href="#help-section" onclick="toggleMobileDrawer()" style="font-weight:700; font-size:16px;">❓ Informasi Acara</a>
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
          
          <!-- Slide 1: Light and Glow Main -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop" alt="Hero Slide 1" id="cmsSlide1Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide1Tag">Event Akbar Bukittinggi 2026</span>
              <h1 class="hero-title" id="cmsSlide1Title">Light And Glow Bukittinggi 2026: 5K Night Run & Concert</h1>
              <p class="hero-desc" id="cmsSlide1Desc">Sensasi lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser musik spektakuler di Jam Gadang Bukittinggi!</p>
              <a href="#tiket-section" class="btn-hero-action">
                <i data-lucide="ticket" style="width:18px;height:18px;"></i>
                Beli Tiket Sekarang
              </a>
            </div>
          </div>

          <!-- Slide 2: 5K Glow Experience -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1200&auto=format&fit=crop&q=80" alt="Hero Slide 2" id="cmsSlide2Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide2Tag" style="background:var(--goers-teal);">5K Glow Experience</span>
              <h1 class="hero-title" id="cmsSlide2Title">Sensasi Lari Malam Penuh Cahaya di Jam Gadang</h1>
              <p class="hero-desc" id="cmsSlide2Desc">Jelajahi keindahan malam Kota Wisata Bukittinggi bersama ribuan pelari dengan jersey neon, LED glasses, dan medali finisher eksklusif.</p>
              <a href="#tiket-section" class="btn-hero-action" style="background:var(--goers-teal);">
                <i data-lucide="compass" style="width:18px;height:18px;"></i>
                Pilih Paket Tiket
              </a>
            </div>
          </div>

          <!-- Slide 3: Live Music & Light Show -->
          <div class="hero-slide">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1200&q=80" alt="Hero Slide 3" id="cmsSlide3Img" class="hero-slide-bg" />
            <div class="hero-slide-overlay"></div>
            <div class="hero-slide-content">
              <span class="hero-tag" id="cmsSlide3Tag" style="background:#7B1FA2;">Music & Light Show</span>
              <h1 class="hero-title" id="cmsSlide3Title">Pesta Cahaya Spektakuler & Live Music Stage</h1>
              <p class="hero-desc" id="cmsSlide3Desc">Nikmati dentuman panggung hiburan musik langsung, pertunjukan laser cahaya megah, dan pesta kembang api di pelataran Jam Gadang!</p>
              <a href="#tiket-section" class="btn-hero-action" style="background:#7B1FA2;">
                <i data-lucide="sparkles" style="width:18px;height:18px;"></i>
                Dapatkan Tiket VIP
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

  {{--
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
  --}}

  <!-- Section 1: Kategori Tiket Light & Glow -->
  <section class="section-wrap" id="tiket-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="sparkles" style="width:14px;height:14px;"></i> Tiket Resmi Light and Glow 2026</span>
          <h2 class="section-title" id="cmsConcertTitle">Kategori Tiket & Paket Peserta</h2>
          <p class="section-subtitle" id="cmsConcertDesc">Pilih tiket favoritmu untuk sensasi lari malam 5K dan konser spektakuler di Jam Gadang Bukittinggi</p>
        </div>
        <a href="#tiket-section" class="btn-view-all">Semua Kategori <i data-lucide="arrow-right" style="width:16px;height:16px;"></i></a>
      </div>

      <div class="event-grid" id="eventsContainer">
        <!-- Event Card 1 -->
        <div class="event-card" data-category="konser" data-name="Early Bird - Festival Pass">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Festival Run</span>
            <span class="event-badge-sale">Early Bird</span>
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=600&q=80" alt="Early Bird" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                Sabtu, 25 April 2026
              </div>
              <h3 class="event-name">Early Bird - Festival Pass</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Jam Gadang, Bukittinggi
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 99.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Early Bird - Festival Pass', 'Rp 99.000', '25 April 2026', 'Jam Gadang, Bukittinggi', 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=600&q=80', 'Festival Run')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 2 -->
        <div class="event-card" data-category="konser" data-name="Presale - VIP Glow Run">
          <div class="event-thumbnail">
            <span class="event-badge-floating">VIP Access</span>
            <span class="event-badge-sale">Best Seller</span>
            <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=600&q=80" alt="VIP Glow Run" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                Sabtu, 25 April 2026
              </div>
              <h3 class="event-name">Presale - VIP Glow Run</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Jam Gadang, Bukittinggi
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 275.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Presale - VIP Glow Run', 'Rp 275.000', '25 April 2026', 'Jam Gadang, Bukittinggi', 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=600&q=80', 'VIP Access')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 3 -->
        <div class="event-card" data-category="konser" data-name="Reguler - 5K Night Run">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Reguler Run</span>
            <img src="https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?auto=format&fit=crop&w=600&q=80" alt="5K Night Run" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                Sabtu, 25 April 2026
              </div>
              <h3 class="event-name">Reguler - 5K Night Run</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Jam Gadang, Bukittinggi
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Mulai dari</span>
                <div class="price-value">Rp 150.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Reguler - 5K Night Run', 'Rp 150.000', '25 April 2026', 'Jam Gadang, Bukittinggi', 'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?auto=format&fit=crop&w=600&q=80', 'Reguler Run')">Beli Tiket</button>
            </div>
          </div>
        </div>

        <!-- Event Card 4 -->
        <div class="event-card" data-category="konser" data-name="Squad / Group Bundle (4 Pax)">
          <div class="event-thumbnail">
            <span class="event-badge-floating">Group Bundle</span>
            <span class="event-badge-sale">Hemat Rp 100k</span>
            <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=600&q=80" alt="Group Bundle" loading="lazy" />
          </div>
          <div class="event-body">
            <div>
              <div class="event-date-row">
                <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                Sabtu, 25 April 2026
              </div>
              <h3 class="event-name">Squad / Group Bundle (4 Pax)</h3>
              <div class="event-location-row">
                <i data-lucide="map-pin" style="width:14px;height:14px;"></i>
                Jam Gadang, Bukittinggi
              </div>
            </div>
            <div class="event-footer">
              <div>
                <span class="price-label">Paket 4 Orang</span>
                <div class="price-value">Rp 500.000</div>
              </div>
              <button class="btn-buy-ticket" onclick="showTicketDetail('Squad / Group Bundle (4 Pax)', 'Rp 500.000', '25 April 2026', 'Jam Gadang, Bukittinggi', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=600&q=80', 'Group Pass')">Beli Tiket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 2: Highlight & Sensasi Light & Glow -->
  <div class="goers-container" id="highlight-section">
    <section class="goers-crowd-section">
      <div class="crowd-shapes"></div>
      <div class="goers-container">
        <div class="crowd-layout">
          <!-- Left: Copy & Explanation -->
          <div>
            <div class="crowd-tag">
              <i data-lucide="sparkles" style="width:14px;height:14px;"></i>
              Sensasi Terbesar di Bukittinggi
            </div>
            <h2 class="crowd-title" id="cmsCrowdTitle">
              Rasakan Atmosfer Pesta Cahaya <span>& Musik Spektakuler Terbesar!</span>
            </h2>
            <p class="crowd-description" id="cmsCrowdDesc">
              Bergabung bersama ribuan runners dan pecinta musik di bawah gemerlap langit malam Jam Gadang Bukittinggi. Nikmati pengalaman lari 5K dengan neon glow, holi color powder, pesta laser, dan dentuman musik panggung spektakuler!
            </p>

            <div class="crowd-chips">
              <span class="crowd-chip">🏃 5K Night Run</span>
              <span class="crowd-chip">✨ Neon Glow Show</span>
              <span class="crowd-chip">🎸 Live Concert Stage</span>
              <span class="crowd-chip">🥇 Medali Finisher Logam</span>
              <span class="crowd-chip">📸 Glow Photobooth</span>
              <span class="crowd-chip">🍔 Bazaar Kuliner Malam</span>
            </div>
          </div>

          <!-- Right: Interactive Live Meetup Demo Card -->
          <div>
            <div class="crowd-preview-card">
              <div class="crowd-meetup-header">
                <div class="crowd-avatar">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Official Team" />
                </div>
                <div class="crowd-author-info">
                  <h4>Panitia Light & Glow 2026</h4>
                  <span>Informasi Resmi Penyelenggara</span>
                </div>
              </div>

              <div class="crowd-meetup-body">
                <div class="meetup-title">🏃 5K Night Run & Concert Jam Gadang</div>
                <p style="font-size:13px; color:#D5E4F9; margin-bottom:12px;">
                  "Pengambilan race pack dimulai pukul 14:00 WIB di pelataran Jam Gadang. Acara lari malam start tepat pukul 19:30 WIB dilanjutkan panggung live concert hingga tengah malam!"
                </p>
                <div class="meetup-meta">
                  <div class="meetup-meta-item">
                    <i data-lucide="map-pin" style="width:14px;height:14px; color:#F15A88;"></i>
                    Jam Gadang Gate 1
                  </div>
                  <div class="meetup-meta-item">
                    <i data-lucide="clock" style="width:14px;height:14px; color:#F15A88;"></i>
                    Sabtu, 25 April 2026 (17:00 WIB)
                  </div>
                  <div class="meetup-meta-item">
                    <i data-lucide="users" style="width:14px;height:14px; color:#F15A88;"></i>
                    Kuota 1.500 Runners
                  </div>
                </div>
              </div>

              <div class="crowd-participants-row">
                <div style="display:flex; align-items:center; gap:8px;">
                  <div class="participants-avatars">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=100&q=80" alt="User 1" />
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="User 2" />
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="User 3" />
                    <div class="more-count">+500</div>
                  </div>
                  <span style="font-size:12px; color:#ADC9F4;">85% Kuota Terisi</span>
                </div>

                <a href="#tiket-section" class="btn-buy-ticket" style="background:var(--goers-branding-500); padding:8px 18px; text-decoration:none;">
                  Daftar Sekarang
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  {{--
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
  --}}

  <!-- Section 4: Highlight Rute & Spot Ikonik Bukittinggi -->
  <section class="section-wrap" id="rute-section">
    <div class="goers-container">
      <div class="section-header">
        <div class="section-title-wrap">
          <span class="section-badge"><i data-lucide="map-pin" style="width:14px;height:14px;"></i> Rute & Venue Event</span>
          <h2 class="section-title">Highlight Rute & Spot Ikonik Bukittinggi</h2>
          <p class="section-subtitle">Rute lari malam 5K melewati berbagai ikon wisata malam Kota Bukittinggi yang mempesona</p>
        </div>
      </div>

      <div class="destination-grid">
        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=400&q=80" alt="Jam Gadang" />
          <div class="destination-overlay">
            <div class="destination-city">Jam Gadang</div>
            <div class="destination-count">Start & Finish / Main Stage</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Ngarai Sianok" />
          <div class="destination-overlay">
            <div class="destination-city">Ngarai Sianok</div>
            <div class="destination-count">Panorama Viewpoint & Photobooth</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=400&q=80" alt="Benteng Fort de Kock" />
          <div class="destination-overlay">
            <div class="destination-city">Fort de Kock</div>
            <div class="destination-count">Neon Light Tunnel Zone</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=400&q=80" alt="Jembatan Limpapeh" />
          <div class="destination-overlay">
            <div class="destination-city">Jembatan Limpapeh</div>
            <div class="destination-count">Cheering Station & DJ Booth</div>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80" alt="Pasar Atas" />
          <div class="destination-overlay">
            <div class="destination-city">Pelataran Pasar Atas</div>
            <div class="destination-count">Glow Festival Food & Bazaar</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="goers-footer" id="help-section">
    <div class="goers-container">
      <div class="footer-top-grid">
        <!-- Brand & Description -->
        <div class="footer-brand">
          <h2>LIGHT & GLOW<span>.</span></h2>
          <p>
            Light and Glow Bukittinggi 2026 adalah perayaan akbar lari malam 5K dan konser spektakuler bertabur cahaya neon terbesar di Kota Bukittinggi, Sumatera Barat. Menyatukan semangat olahraga, pesona visual cahaya, dan hiburan panggung berkelas.
          </p>
          <div class="social-links">
            <a href="#" class="social-icon-btn" aria-label="Instagram">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
            </a>
            <a href="#" class="social-icon-btn" aria-label="Facebook">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" class="social-icon-btn" aria-label="Twitter / X">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
          </div>
        </div>

        <!-- Col 1 -->
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul class="footer-links">
            <li><a href="#tiket-section">Kategori Tiket</a></li>
            <li><a href="#highlight-section">Highlight Acara</a></li>
            <li><a href="#rute-section">Rute & Venue</a></li>
            <li><a href="{{ route('buyer.dashboard') }}">Tiket Saya</a></li>
            <li><a href="{{ route('login') }}">Admin Portal</a></li>
          </ul>
        </div>

        <!-- Col 2 -->
        <div class="footer-col">
          <h4>Tentang Acara</h4>
          <ul class="footer-links">
            <li><a href="#">Light & Glow 2026</a></li>
            <li><a href="#">Jadwal Pengambilan Race Pack</a></li>
            <li><a href="#">Tata Tertib Lari Malam</a></li>
            <li><a href="#">Line-up Musisi Konser</a></li>
            <li><a href="#">Panduan Akses & Parkir</a></li>
          </ul>
        </div>

        <!-- Col 3 -->
        <div class="footer-col">
          <h4>Bantuan & Info</h4>
          <ul class="footer-links">
            <li><a href="#">Pusat Informasi Tiket</a></li>
            <li><a href="#">Tata Cara Bayar QRIS</a></li>
            <li><a href="#">Hubungi Panitia Pelaksana</a></li>
            <li><a href="#">Syarat dan Ketentuan</a></li>
            <li><a href="#">Kebijakan Privasi</a></li>
          </ul>
        </div>

        <!-- Col 4: Newsletter -->
        <div class="footer-col">
          <h4>Info Kuota & Promo</h4>
          <p style="font-size:12px; margin-bottom:12px; color:#9CA3AF;">Dapatkan kabar update kuota tiket dan info bintang tamu panggung konser langsung ke emailmu.</p>
          <form class="newsletter-form" onsubmit="handleSubscribe(event)">
            <div class="newsletter-input-group">
              <input type="email" required placeholder="Alamat email Anda..." class="newsletter-input" />
              <button type="submit" class="btn-newsletter">Kirim</button>
            </div>
            <span id="subSuccess" style="color:#10B981; font-size:12px; display:none;">Terima kasih telah berlangganan!</span>
          </form>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div>
          &copy; 2026 Light and Glow Run Bukittinggi. All Rights Reserved.
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
      Kami menggunakan cookies untuk mempermudah pengalaman Anda saat memesan tiket di website resmi Light and Glow Bukittinggi.
    </div>
    <button class="btn-cookie-accept" onclick="acceptCookies()">Saya Setuju</button>
  </div>

  <!-- Ticket Detail & Booking Modal -->
  <div class="modal-overlay" id="ticketModal" onclick="closeModalOnOverlay(event)">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Detail Tiket Light & Glow</h3>
        <button class="modal-close-btn" onclick="closeTicketModal()"><i data-lucide="x" style="width:20px;height:20px;"></i></button>
      </div>
      <div class="modal-body">
        <img id="modalImg" class="modal-image" src="" alt="Detail Tiket" />
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
          <span id="modalCategory" style="background:var(--goers-branding-100); color:var(--goers-branding-500); font-weight:800; font-size:12px; padding:4px 10px; border-radius:4px;">Kategori</span>
          <span id="modalDate" style="font-size:13px; font-weight:700; color:var(--goers-navy-900);">Tanggal</span>
        </div>
        <h2 id="modalEventName" style="font-size:20px; font-weight:800; color:var(--goers-navy-900); margin-bottom:10px;">Nama Paket Tiket</h2>
        <div style="display:flex; align-items:center; gap:6px; font-size:13px; color:var(--goers-gray-700); margin-bottom:16px;">
          <i data-lucide="map-pin" style="width:16px;height:16px;"></i>
          <span id="modalLocation">Jam Gadang, Bukittinggi</span>
        </div>
        <div style="border-top:1px solid var(--goers-gray-300); padding-top:14px;">
          <h4 style="font-size:14px; font-weight:700; margin-bottom:6px;">Tentang Tiket & Event:</h4>
          <p style="font-size:13px; color:var(--goers-gray-800); line-height:1.6;">
            E-tiket resmi dan QR Code unik akan otomatis tersimpan di menu <strong>Tiket Saya</strong> & dikirimkan ke email Anda setelah pembayaran QRIS diverifikasi oleh admin. Tunjukkan QR Code digital kepada petugas scanner saat pengambilan race pack dan hari acara.
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
        if (d.brandLogoText && d.brandLogoText.toUpperCase().includes('GOERS')) {
          localStorage.removeItem('goers_full_cms');
          return;
        }
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
