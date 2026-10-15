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

  <!-- Adminator Native Template Modal Popup -->
  <div id="adminatorTicketModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeTicketAdminModal()">
    <div class="adminator-modal">
      <div class="adminator-modal-head">
        <h3 id="adminModalTitle" class="adminator-modal-title">Kelola Tiket</h3>
        <button class="adminator-modal-close" onclick="closeTicketAdminModal()" aria-label="Tutup">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="adminator-modal-body">
        <input type="hidden" id="modalTicketIndex" value="-1">
        <div style="display:flex; flex-direction:column; gap:14px;">
          <div>
            <label class="field-label">Nama Tiket <span class="req">*</span></label>
            <input id="inputTicketName" class="input" placeholder="Contoh: VIP Neon Glowing Pass">
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label class="field-label">Harga <span class="req">*</span></label>
              <input id="inputTicketPrice" class="input" placeholder="Contoh: Rp 250.000">
            </div>
            <div>
              <label class="field-label">Kategori / Benefit</label>
              <input id="inputTicketCategory" class="input" placeholder="Contoh: Akses Depan">
            </div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label class="field-label">Tanggal</label>
              <input id="inputTicketDate" class="input" value="25 Apr 2026">
            </div>
            <div>
              <label class="field-label">Lokasi</label>
              <input id="inputTicketLocation" class="input" value="Jam Gadang, Bukittinggi">
            </div>
          </div>
          <div>
            <label class="field-label">URL Foto Tiket</label>
            <input id="inputTicketImg" class="input" placeholder="https://images.unsplash.com/...">
          </div>
        </div>
      </div>
      <div class="adminator-modal-foot">
        <button class="btn btn--ghost" onclick="closeTicketAdminModal()">Batal</button>
        <button class="btn btn--primary" onclick="saveTicketFromModal()">Simpan Tiket</button>
      </div>
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

    function closeTicketAdminModal() {
      document.getElementById('adminatorTicketModal').style.display = 'none';
    }

    function openAddTicketModal() {
      document.getElementById('modalTicketIndex').value = '-1';
      document.getElementById('adminModalTitle').textContent = 'Tambah Tiket Baru';
      document.getElementById('inputTicketName').value = '';
      document.getElementById('inputTicketPrice').value = '';
      document.getElementById('inputTicketCategory').value = '';
      document.getElementById('inputTicketDate').value = '25 Apr 2026';
      document.getElementById('inputTicketLocation').value = 'Jam Gadang, Bukittinggi';
      document.getElementById('inputTicketImg').value = 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60';
      
      document.getElementById('adminatorTicketModal').style.display = 'flex';
    }

    function editTicket(index) {
      const cms = getStorageData();
      const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : DEFAULT_TICKETS;
      const t = tickets[index];

      document.getElementById('modalTicketIndex').value = index;
      document.getElementById('adminModalTitle').textContent = 'Edit Data Tiket';
      document.getElementById('inputTicketName').value = t.name;
      document.getElementById('inputTicketPrice').value = t.price;
      document.getElementById('inputTicketCategory').value = t.category;
      document.getElementById('inputTicketDate').value = t.date;
      document.getElementById('inputTicketLocation').value = t.location;
      document.getElementById('inputTicketImg').value = t.img;

      document.getElementById('adminatorTicketModal').style.display = 'flex';
    }

    function saveTicketFromModal() {
      const name = document.getElementById('inputTicketName').value;
      const price = document.getElementById('inputTicketPrice').value;
      const category = document.getElementById('inputTicketCategory').value || 'Tiket Masuk';
      const date = document.getElementById('inputTicketDate').value;
      const location = document.getElementById('inputTicketLocation').value;
      const img = document.getElementById('inputTicketImg').value || 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60';
      const index = parseInt(document.getElementById('modalTicketIndex').value);

      if (!name || !price) {
        alert('Nama tiket dan harga wajib diisi!');
        return;
      }

      const ticketObj = { name, price, category, date, location, img };
      const cms = getStorageData();
      const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : [...DEFAULT_TICKETS];

      closeTicketAdminModal();

      if (index >= 0) {
        tickets[index] = ticketObj;
        cms.tickets = tickets;
        saveStorageData(cms);
        renderTickets();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Diedit!',
          text: 'Data tiket berhasil diperbarui.',
          timer: 1500,
          showConfirmButton: false
        });
      } else {
        tickets.push(ticketObj);
        cms.tickets = tickets;
        saveStorageData(cms);
        renderTickets();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Ditambahkan!',
          text: 'Tiket baru telah berhasil ditambahkan.',
          timer: 1500,
          showConfirmButton: false
        });
      }
    }

    function deleteTicket(index) {
      if (confirm('Yakin ingin menghapus tiket ini?')) {
        const cms = getStorageData();
        const tickets = (cms.tickets && cms.tickets.length > 0) ? cms.tickets : [...DEFAULT_TICKETS];
        tickets.splice(index, 1);
        cms.tickets = tickets;
        saveStorageData(cms);
        renderTickets();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Dihapus!',
          text: 'Tiket telah berhasil dihapus.',
          timer: 1500,
          showConfirmButton: false
        });
      }
    }

    function resetTickets() {
      if (confirm('Kembalikan seluruh daftar tiket ke default awal?')) {
        const cms = getStorageData();
        cms.tickets = [...DEFAULT_TICKETS];
        saveStorageData(cms);
        renderTickets();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Direset!',
          text: 'Daftar tiket telah dikembalikan ke bawaan.',
          timer: 1500,
          showConfirmButton: false
        });
      }
    }

    document.addEventListener('DOMContentLoaded', renderTickets);
  </script>
</body>
</html>
