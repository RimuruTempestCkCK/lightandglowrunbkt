<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Inter+Tight:wght@500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap">
  <title>Master Tiket & Kuota · Light And Glow Bukittinggi</title>
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
    .tiket-table-wrap {
      overflow-x: auto;
      background: var(--bg-card);
      border-radius: 12px;
      border: 1px solid var(--border-soft);
      padding: 20px;
    }
    .thumb-preview {
      width: 48px;
      height: 48px;
      border-radius: 8px;
      object-fit: cover;
    }
    .btn-action-group {
      display: flex;
      gap: 6px;
      justify-content: flex-end;
    }
  </style>
</head>
<body data-active="tiket_direct" data-crumbs="Master Data | Master Tiket & Kuota">
  <div class="shell">
    <div data-shell-sidebar></div>
    <div class="main">
      <div data-shell-topbar></div>
      <main class="content">
        
        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Master Data</span>
            <h1 class="hero-title">Kelola <span class="accent">Tiket & Harga</span></h1>
            <p class="hero-sub">Kelola kategori tiket, harga, kuota, tanggal event, serta gambar tiket yang tampil di Landing Page secara real-time.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--ghost" onclick="resetTickets()">
              <svg viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              Reset Default
            </button>
            <button class="btn btn--primary" onclick="openAddTicketModal()">
              <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Tiket Baru
            </button>
          </div>
        </section>

        <!-- KPI Summary Cards -->
        <section class="kpi-grid" style="margin-bottom: 24px;">
          <article class="kpi-card c-primary">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon primary"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M3 16h18M9 4v16"/></svg></div>
                <div class="kpi-label">Total Jenis Tiket</div>
              </div>
              <span class="kpi-pill up" id="kpiTotalJenis">4 Kategori</span>
            </div>
            <div class="kpi-value" id="kpiTotalCount">4</div>
            <div class="kpi-compare">Semua tampil aktif di Landing Page</div>
          </article>

          <article class="kpi-card c-success">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon success"><svg viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
                <div class="kpi-label">Harga Terendah</div>
              </div>
              <span class="kpi-pill up">Early Bird</span>
            </div>
            <div class="kpi-value">Rp 99.000</div>
            <div class="kpi-compare">Tiket Festival Pass</div>
          </article>

          <article class="kpi-card c-purple">
            <div class="kpi-top">
              <div class="kpi-identity">
                <div class="kpi-icon purple"><svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <div class="kpi-label">Kategori VIP</div>
              </div>
              <span class="kpi-pill flat">Best Seller</span>
            </div>
            <div class="kpi-value">Rp 275.000</div>
            <div class="kpi-compare">Termasuk akses depan panggung</div>
          </article>
        </section>

        <!-- Table Master Tiket -->
        <div class="tiket-table-wrap">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Daftar Master Tiket</span>
              <h2 class="card-title">Katalog Tiket Light And Glow Bukittinggi</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th style="width: 60px;">Foto</th>
                <th>Nama Tiket</th>
                <th>Kategori / Benefit</th>
                <th>Harga</th>
                <th>Tanggal Acara</th>
                <th>Lokasi</th>
                <th style="text-align: right;">Aksi</th>
              </tr>
            </thead>
            <tbody id="ticketTableBody">
              <!-- Rendered via JS -->
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const DEFAULT_TICKETS = [
      {
        name: "Early Bird - Festival Pass",
        price: "Rp 99.000",
        date: "25 Apr 2026",
        location: "Jam Gadang, Bukittinggi",
        img: "https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=60",
        category: "Lari Santai + Neon Pack"
      },
      {
        name: "Presale - VIP Glow Run",
        price: "Rp 275.000",
        date: "25 Apr 2026",
        location: "Jam Gadang, Bukittinggi",
        img: "https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=500&auto=format&fit=crop&q=60",
        category: "Akses VIP Depan Panggung"
      },
      {
        name: "Reguler - 5K Night Run",
        price: "Rp 150.000",
        date: "25 Apr 2026",
        location: "Jam Gadang, Bukittinggi",
        img: "https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=500&auto=format&fit=crop&q=60",
        category: "Jersey + Medali Finisher"
      },
      {
        name: "Squad / Group Bundle (4 Pax)",
        price: "Rp 500.000",
        date: "25 Apr 2026",
        location: "Jam Gadang, Bukittinggi",
        img: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60",
        category: "Paket Hemat 4 Peserta"
      }
    ];

    function getStorageData() {
      const raw = localStorage.getItem('goers_full_cms');
      return raw ? JSON.parse(raw) : {};
    }

    function saveStorageData(cmsData) {
      localStorage.setItem('goers_full_cms', JSON.stringify(cmsData));
    }

    function renderTickets() {
      const cms = getStorageData();
      const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : DEFAULT_TICKETS;
      
      const tbody = document.getElementById('ticketTableBody');
      tbody.innerHTML = '';

      tickets.forEach((t, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><img src="${t.img}" class="thumb-preview" alt="${t.name}"></td>
          <td><strong>${t.name}</strong></td>
          <td><span class="tag" style="background:rgba(235,19,85,0.15); color:var(--primary); font-weight:600; padding:3px 8px; border-radius:4px;">${t.category}</span></td>
          <td><strong style="color:var(--primary);">${t.price}</strong></td>
          <td>${t.date}</td>
          <td>${t.location}</td>
          <td style="text-align: right;">
            <div class="btn-action-group">
              <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px;" onclick="editTicket(${index})">Edit</button>
              <button class="btn btn--ghost" style="padding:4px 8px; font-size:12px; color:var(--danger);" onclick="deleteTicket(${index})">Hapus</button>
            </div>
          </td>
        `;
        tbody.appendChild(tr);
      });

      document.getElementById('kpiTotalCount').textContent = tickets.length;
      document.getElementById('kpiTotalJenis').textContent = tickets.length + ' Kategori';
    }

    function editTicket(index) {
      const cms = getStorageData();
      const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : DEFAULT_TICKETS;
      const t = tickets[index];

      Swal.fire({
        title: 'Edit Master Tiket',
        html: `
          <div style="text-align:left; font-size:13px; display:flex; flex-direction:column; gap:10px;">
            <div>
              <label><b>Nama Tiket:</b></label>
              <input id="swal-name" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.name}">
            </div>
            <div>
              <label><b>Harga:</b></label>
              <input id="swal-price" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.price}">
            </div>
            <div>
              <label><b>Kategori / Benefit:</b></label>
              <input id="swal-category" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.category}">
            </div>
            <div>
              <label><b>Tanggal:</b></label>
              <input id="swal-date" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.date}">
            </div>
            <div>
              <label><b>Lokasi:</b></label>
              <input id="swal-location" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.location}">
            </div>
            <div>
              <label><b>URL Foto Tiket:</b></label>
              <input id="swal-img" class="swal2-input" style="width:100%; margin:4px 0 0;" value="${t.img}">
            </div>
          </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Simpan Perubahan',
        cancelButtonText: 'Batal',
        preConfirm: () => {
          return {
            name: document.getElementById('swal-name').value,
            price: document.getElementById('swal-price').value,
            category: document.getElementById('swal-category').value,
            date: document.getElementById('swal-date').value,
            location: document.getElementById('swal-location').value,
            img: document.getElementById('swal-img').value
          };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          tickets[index] = result.value;
          cms.tickets = tickets;
          saveStorageData(cms);
          renderTickets();
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Diperbarui!',
            text: 'Data master tiket berhasil disimpan dan terintegrasi ke Landing Page.',
            confirmButtonColor: '#EB1355'
          });
        }
      });
    }

    function openAddTicketModal() {
      Swal.fire({
        title: 'Tambah Tiket Baru',
        html: `
          <div style="text-align:left; font-size:13px; display:flex; flex-direction:column; gap:10px;">
            <div>
              <label><b>Nama Tiket:</b></label>
              <input id="swal-name" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: VIP Neon Glowing Pass">
            </div>
            <div>
              <label><b>Harga:</b></label>
              <input id="swal-price" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: Rp 200.000">
            </div>
            <div>
              <label><b>Kategori / Benefit:</b></label>
              <input id="swal-category" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: Akses Depan + Goodie Bag">
            </div>
            <div>
              <label><b>Tanggal:</b></label>
              <input id="swal-date" class="swal2-input" style="width:100%; margin:4px 0 0;" value="25 Apr 2026">
            </div>
            <div>
              <label><b>Lokasi:</b></label>
              <input id="swal-location" class="swal2-input" style="width:100%; margin:4px 0 0;" value="Jam Gadang, Bukittinggi">
            </div>
            <div>
              <label><b>URL Foto Tiket:</b></label>
              <input id="swal-img" class="swal2-input" style="width:100%; margin:4px 0 0;" value="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60">
            </div>
          </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Tambah Tiket',
        cancelButtonText: 'Batal',
        preConfirm: () => {
          const name = document.getElementById('swal-name').value;
          const price = document.getElementById('swal-price').value;
          if (!name || !price) {
            Swal.showValidationMessage('Nama dan harga tiket wajib diisi!');
            return false;
          }
          return {
            name: name,
            price: price,
            category: document.getElementById('swal-category').value || 'Tiket Masuk',
            date: document.getElementById('swal-date').value,
            location: document.getElementById('swal-location').value,
            img: document.getElementById('swal-img').value
          };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const cms = getStorageData();
          const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : [...DEFAULT_TICKETS];
          tickets.push(result.value);
          cms.tickets = tickets;
          saveStorageData(cms);
          renderTickets();
          Swal.fire({
            icon: 'success',
            title: 'Tiket Berhasil Ditambahkan!',
            text: 'Tiket baru otomatis tersedia di katalog penjualan.',
            confirmButtonColor: '#EB1355'
          });
        }
      });
    }

    function deleteTicket(index) {
      Swal.fire({
        title: 'Hapus Tiket Ini?',
        text: 'Kategori tiket ini tidak akan lagi tampil di halaman checkout pengunjung.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          const cms = getStorageData();
          const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : [...DEFAULT_TICKETS];
          tickets.splice(index, 1);
          cms.tickets = tickets;
          saveStorageData(cms);
          renderTickets();
          Swal.fire({
            icon: 'success',
            title: 'Tiket Dihapus!',
            text: 'Data tiket berhasil dihapus dari sistem.',
            confirmButtonColor: '#EB1355'
          });
        }
      });
    }

    function resetTickets() {
      Swal.fire({
        title: 'Reset ke Bawaan?',
        text: 'Kembalikan seluruh daftar tiket ke default Light And Glow Bukittinggi?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EB1355',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Ya, Reset',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          const cms = getStorageData();
          cms.tickets = [...DEFAULT_TICKETS];
          saveStorageData(cms);
          renderTickets();
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset',
            text: 'Katalog tiket dikembalikan ke daftar awal.',
            timer: 1500,
            showConfirmButton: false
          });
        }
      });
    }

    document.addEventListener('DOMContentLoaded', renderTickets);
  </script>
</body>
</html>
