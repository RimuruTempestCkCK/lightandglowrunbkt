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
  <title>Master Banner Hero Carousel · Light And Glow Bukittinggi</title>
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
      height: 180px;
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
      transform: scale(1.05);
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
    .banner-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--t-base);
      margin-bottom: 8px;
    }
    .banner-desc {
      font-size: 13px;
      color: var(--t-muted);
      line-height: 1.5;
      margin-bottom: 16px;
      flex: 1;
    }
    .banner-actions {
      display: flex;
      gap: 8px;
      border-top: 1px solid var(--border-soft);
      padding-top: 12px;
    }
  </style>
</head>
<body data-active="banner_direct" data-crumbs="Master Data | Master Banner Hero">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Master Data</span>
            <h1 class="hero-title">Kelola <span class="accent">Banner Hero Carousel</span></h1>
            <p class="hero-sub">Atur 3 banner carousel utama pada Landing Page: judul promosi, tagline, deskripsi, dan foto background berkualitas tinggi.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="resetBanners()">
              <svg viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              Reset Bawaan
            </button>
          </div>
        </section>

        <!-- Banner Grid -->
        <div class="banner-grid" id="bannerContainer">
          <!-- Rendered via JS -->
        </div>

        <!-- Section Pengumuman Bar Atas (Flash Sale Announcement) -->
        <div class="card" style="padding: 24px; margin-top: 12px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Top Header Bar</span>
              <h2 class="card-title">Teks Pengumuman Flash Sale & Promo Bar</h2>
            </div>
          </div>
          <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:13px; font-weight:600; color:var(--t-muted); margin-bottom:6px;">Teks Berjalan / Bar Pengumuman Atas</label>
            <input type="text" id="topBarText" class="cms-input" style="width:100%; padding:10px 14px; border-radius:6px; border:1px solid var(--border); background:var(--bg-body); color:var(--t-base);" value="⚡ FLASH SALE PRESALE TIKET LIGHT AND GLOW BUKITTINGGI TELAH DIBUKA! DAPATKAN HARGA SPESIAL SEKARANG!">
          </div>
          <button class="btn btn--primary" onclick="saveTopBarText()">Simpan Teks Pengumuman</button>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Native Template Modal Popup -->
  <div id="adminatorBannerModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeBannerAdminModal()">
    <div class="adminator-modal">
      <div class="adminator-modal-head">
        <h3 id="adminBannerModalTitle" class="adminator-modal-title">Edit Slide Banner</h3>
        <button class="adminator-modal-close" onclick="closeBannerAdminModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <input type="hidden" id="modalBannerId" value="1">
        <div style="display:flex; flex-direction:column; gap:14px;">
          <div>
            <label class="field-label">Tag / Kategori Promosi</label>
            <input id="inputBannerTag" class="input" placeholder="Contoh: SPECIAL GUEST STARS">
          </div>
          <div>
            <label class="field-label">Judul Utama Slide <span class="req">*</span></label>
            <input id="inputBannerTitle" class="input" placeholder="Judul slide banner...">
          </div>
          <div>
            <label class="field-label">Deskripsi Promo</label>
            <textarea id="inputBannerDesc" class="textarea" rows="3" placeholder="Deskripsi..."></textarea>
          </div>
          <div>
            <label class="field-label">URL Foto Background</label>
            <input id="inputBannerImg" class="input" placeholder="https://images.unsplash.com/...">
          </div>
        </div>
      </div>
      <div class="adminator-modal-foot">
        <button class="btn btn--ghost" onclick="closeBannerAdminModal()">Batal</button>
        <button class="btn btn--primary" onclick="saveBannerFromModal()">Simpan Banner</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const DEFAULT_BANNERS = [
      {
        id: 1,
        tag: "NIGHT RUN & CONCERT",
        img: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop",
        title: "Light And Glow Bukittinggi 2026",
        desc: "Sensasi lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser spektakuler di Jam Gadang Bukittinggi."
      },
      {
        id: 2,
        tag: "SPECIAL GUEST STARS",
        img: "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1200&auto=format&fit=crop",
        title: "Deretan DJ & Artis Ternama",
        desc: "Panggung musik megah dengan tata cahaya laser visual memukau menemani pesta neon sampai malam."
      },
      {
        id: 3,
        tag: "LIMITED EARLY BIRD",
        img: "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1200&auto=format&fit=crop",
        title: "Dapatkan Tiket Spesial Kamu!",
        desc: "Termasuk Glow Pack eksklusif (Neon Tee, LED Glasses, Glow Stick, Medal Finisher & Refreshment)."
      }
    ];

    function getStorageData() {
      const raw = localStorage.getItem('goers_full_cms');
      return raw ? JSON.parse(raw) : {};
    }

    function saveStorageData(cmsData) {
      localStorage.setItem('goers_full_cms', JSON.stringify(cmsData));
    }

    function renderBanners() {
      const cms = getStorageData();
      const container = document.getElementById('bannerContainer');
      container.innerHTML = '';

      const banners = [
        {
          id: 1,
          tag: cms.slide1Tag || DEFAULT_BANNERS[0].tag,
          img: cms.slide1Img || DEFAULT_BANNERS[0].img,
          title: cms.slide1Title || DEFAULT_BANNERS[0].title,
          desc: cms.slide1Desc || DEFAULT_BANNERS[0].desc
        },
        {
          id: 2,
          tag: cms.slide2Tag || DEFAULT_BANNERS[1].tag,
          img: cms.slide2Img || DEFAULT_BANNERS[1].img,
          title: cms.slide2Title || DEFAULT_BANNERS[1].title,
          desc: cms.slide2Desc || DEFAULT_BANNERS[1].desc
        },
        {
          id: 3,
          tag: cms.slide3Tag || DEFAULT_BANNERS[2].tag,
          img: cms.slide3Img || DEFAULT_BANNERS[2].img,
          title: cms.slide3Title || DEFAULT_BANNERS[2].title,
          desc: cms.slide3Desc || DEFAULT_BANNERS[2].desc
        }
      ];

      banners.forEach((b) => {
        const card = document.createElement('div');
        card.className = 'banner-card';
        card.innerHTML = `
          <div class="banner-img-wrap">
            <img src="${b.img}" alt="${b.title}">
            <div class="banner-badge">Slide #${b.id} · ${b.tag}</div>
          </div>
          <div class="banner-content">
            <h3 class="banner-title">${b.title}</h3>
            <p class="banner-desc">${b.desc}</p>
            <div class="banner-actions">
              <button class="btn btn--primary" style="flex:1; justify-content:center;" onclick="editBanner(${b.id})">
                <svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4z"/></svg>
                Edit Banner #${b.id}
              </button>
            </div>
          </div>
        `;
        container.appendChild(card);
      });

      if (cms.topBarText) {
        document.getElementById('topBarText').value = cms.topBarText;
      }
    }

    function closeBannerAdminModal() {
      document.getElementById('adminatorBannerModal').style.display = 'none';
    }

    function editBanner(id) {
      const cms = getStorageData();
      const current = {
        tag: cms[`slide${id}Tag`] || DEFAULT_BANNERS[id - 1].tag,
        img: cms[`slide${id}Img`] || DEFAULT_BANNERS[id - 1].img,
        title: cms[`slide${id}Title`] || DEFAULT_BANNERS[id - 1].title,
        desc: cms[`slide${id}Desc`] || DEFAULT_BANNERS[id - 1].desc
      };

      document.getElementById('modalBannerId').value = id;
      document.getElementById('adminBannerModalTitle').textContent = `Edit Slide Banner #${id}`;
      document.getElementById('inputBannerTag').value = current.tag;
      document.getElementById('inputBannerTitle').value = current.title;
      document.getElementById('inputBannerDesc').value = current.desc;
      document.getElementById('inputBannerImg').value = current.img;

      document.getElementById('adminatorBannerModal').style.display = 'flex';
    }

    function saveBannerFromModal() {
      const id = document.getElementById('modalBannerId').value;
      const tag = document.getElementById('inputBannerTag').value;
      const title = document.getElementById('inputBannerTitle').value;
      const desc = document.getElementById('inputBannerDesc').value;
      const img = document.getElementById('inputBannerImg').value;

      if (!title) {
        alert('Judul banner tidak boleh kosong!');
        return;
      }

      const cms = getStorageData();
      cms[`slide${id}Tag`] = tag;
      cms[`slide${id}Title`] = title;
      cms[`slide${id}Desc`] = desc;
      cms[`slide${id}Img`] = img;
      saveStorageData(cms);

      closeBannerAdminModal();
      renderBanners();

      Swal.fire({
        icon: 'success',
        title: 'Berhasil Diedit!',
        text: `Slide banner #${id} telah berhasil diperbarui.`,
        timer: 1500,
        showConfirmButton: false
      });
    }

    function saveTopBarText() {
      const cms = getStorageData();
      cms.topBarText = document.getElementById('topBarText').value;
      saveStorageData(cms);
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Diedit!',
        text: 'Teks bar pengumuman telah diperbarui.',
        timer: 1500,
        showConfirmButton: false
      });
    }

    function resetBanners() {
      if (confirm('Kembalikan 3 slide hero carousel ke gambar dan judul default awal?')) {
        const cms = getStorageData();
        DEFAULT_BANNERS.forEach((b) => {
          delete cms[`slide${b.id}Tag`];
          delete cms[`slide${b.id}Title`];
          delete cms[`slide${b.id}Desc`];
          delete cms[`slide${b.id}Img`];
        });
        saveStorageData(cms);
        renderBanners();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Direset!',
          text: 'Slide banner dikembalikan ke konfigurasi default.',
          timer: 1500,
          showConfirmButton: false
        });
      }
    }

    document.addEventListener('DOMContentLoaded', renderBanners);
  </script>
</body>
</html>
