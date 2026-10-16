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
    .acara-table-wrap {
      overflow-x: auto;
      background: var(--bg-card);
      border-radius: 12px;
      border: 1px solid var(--border-soft);
      padding: 20px;
    }
    .thumb-qris {
      width: 52px;
      height: 52px;
      border-radius: 8px;
      object-fit: contain;
      background: #fff;
      border: 1px solid var(--border-soft);
      padding: 2px;
    }
    .empty-data-alert {
      color: #ef4444;
      font-weight: 600;
      font-size: 13px;
    }
    .alert-banner {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      font-weight: 500;
    }
    .alert-success {
      background: #ECFDF5;
      color: #065F46;
      border: 1px solid #A7F3D0;
    }
    .alert-danger {
      background: #FEF2F2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }
    .qris-preview-box {
      width: 140px;
      height: 140px;
      border: 2px dashed var(--border);
      border-radius: 10px;
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
        
        <!-- Alerts Notification -->
        @if(session('success'))
          <div class="alert-banner alert-success">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert-banner alert-danger">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
          </div>
        @endif

        <!-- Hero Section -->
        <section class="hero" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Database MySQL Real-Time</span>
            <h1 class="hero-title">Master <span class="accent">Acara & QRIS</span></h1>
            <p class="hero-sub">Daftar konfigurasi utama event acara dan barcode QRIS pembayaran tiket. Data bersifat single master (hanya dapat diedit).</p>
          </div>
          <div class="hero-actions">
            @if(!$event)
              <button class="btn btn--primary" onclick="openAddAcaraModal()">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Data Acara
              </button>
            @endif
          </div>
        </section>

        <!-- Tabel Master Acara & QRIS -->
        <div class="acara-table-wrap">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Data Database Terkini</span>
              <h2 class="card-title">Informasi Acara & QRIS Pembayaran</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th style="width: 70px;">QRIS</th>
                <th>Nama Acara</th>
                <th>Lokasi Venue</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Merchant QRIS</th>
                <th>NMID</th>
                <th style="text-align: right; width: 100px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if($event)
                <tr>
                  <td>
                    @if(!empty($event->qris_image))
                      <img src="{{ asset($event->qris_image) }}" class="thumb-qris" alt="QRIS">
                    @else
                      <span class="tag" style="background:rgba(239,68,68,0.12); color:#ef4444; font-size:10px;">Belum Ada</span>
                    @endif
                  </td>
                  <td>
                    <strong style="font-size:14px; color:var(--t-base);">{{ $event->title }}</strong>
                    <span style="font-size:11px; color:var(--text-sub); display:block;">Slug: {{ $event->slug ?? 'light-and-glow-bukittinggi-2026' }}</span>
                  </td>
                  <td>
                    <span style="font-size:13px; color:var(--t-base); font-weight:500;">{{ $event->location }}</span>
                  </td>
                  <td>
                    <span class="tag" style="background:rgba(37,99,235,0.12); color:var(--primary); font-weight:700;">
                      {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                    </span>
                  </td>
                  <td>
                    <strong style="color:var(--t-base);">{{ $event->qris_merchant_name ?? '-' }}</strong>
                  </td>
                  <td>
                    <code style="font-size:11.5px; background:var(--bg-muted); padding:2px 6px; border-radius:4px; color:var(--t-muted);">
                      {{ $event->qris_nmid ?? '-' }}
                    </code>
                  </td>
                  <td style="text-align: right;">
                    <button class="btn btn--primary" style="padding:5px 12px; font-size:12px;" onclick='openEditAcaraModal(@json($event))'>
                      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4z"/></svg>
                      Edit
                    </button>
                  </td>
                </tr>
              @else
                <tr>
                  <td colspan="7" style="text-align:center; padding:36px 20px;">
                    <div class="empty-data-alert" style="margin-bottom: 12px;">
                      ⚠️ Belum ada data acara di database MySQL! Silakan klik tombol "Tambah Data Acara" di atas untuk menambahkan data.
                    </div>
                    <button class="btn btn--primary" onclick="openAddAcaraModal()">
                      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                      Tambah Data Acara Sekarang
                    </button>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Edit / Tambah Acara & QRIS) -->
  <div id="adminatorAcaraModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeAcaraModal()">
    <div class="adminator-modal" style="max-width:540px; width:92%;">
      <form id="modalAcaraForm" method="POST" action="{{ route('admin.acara.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="adminator-modal-head">
          <h3 id="adminAcaraModalTitle" class="adminator-modal-title">Edit Acara & QRIS Pembayaran</h3>
          <button type="button" class="adminator-modal-close" onclick="closeAcaraModal()" aria-label="Tutup">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:16px;">
            
            <!-- Upload QRIS -->
            <div>
              <label class="field-label">Gambar QRIS Pembayaran</label>
              <div style="display:flex; gap:16px; align-items:center; margin-top:6px;">
                <div class="qris-preview-box">
                  <img id="modalQrisPreview" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8" alt="Preview QRIS">
                </div>
                <div style="flex:1;">
                  <input type="file" id="modalQrisFile" name="qris_file" class="input" accept="image/*" onchange="previewModalQris(this)">
                  <span style="font-size:11px; color:var(--t-muted); margin-top:4px; display:block;">
                    Pilih file gambar QRIS baru (JPG, PNG, WEBP). Maks. 5MB.
                  </span>
                </div>
              </div>
            </div>

            <!-- Merchant & NMID -->
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
              <div>
                <label class="field-label">Nama Akun Merchant <span class="req">*</span></label>
                <input id="inputMerchantName" name="qris_merchant_name" class="input" placeholder="LIGHT AND GLOW BUKITTINGGI" required>
              </div>
              <div>
                <label class="field-label">NMID QRIS</label>
                <input id="inputNmid" name="qris_nmid" class="input" placeholder="ID102026xxxxxxxxx">
              </div>
            </div>

            <!-- Nama Acara -->
            <div>
              <label class="field-label">Nama Acara <span class="req">*</span></label>
              <input id="inputEventTitle" name="title" class="input" placeholder="Contoh: Light And Glow Bukittinggi 2026" required>
            </div>

            <!-- Lokasi & Tanggal -->
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
              <div>
                <label class="field-label">Lokasi Venue <span class="req">*</span></label>
                <input id="inputEventLocation" name="location" class="input" placeholder="Contoh: Jam Gadang, Bukittinggi" required>
              </div>
              <div>
                <label class="field-label">Tanggal Pelaksanaan <span class="req">*</span></label>
                <input id="inputEventDate" name="event_date" type="date" class="input" required>
              </div>
            </div>

          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeAcaraModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitModal">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function closeAcaraModal() {
      document.getElementById('adminatorAcaraModal').style.display = 'none';
    }

    function openAddAcaraModal() {
      document.getElementById('adminAcaraModalTitle').textContent = 'Tambah Data Acara & QRIS';
      document.getElementById('inputEventTitle').value = 'Light And Glow Bukittinggi 2026';
      document.getElementById('inputEventLocation').value = 'Jam Gadang, Bukittinggi';
      document.getElementById('inputEventDate').value = '2026-10-24';
      document.getElementById('inputMerchantName').value = 'LIGHT AND GLOW BUKITTINGGI';
      document.getElementById('inputNmid').value = '';
      document.getElementById('modalQrisPreview').src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8';
      document.getElementById('modalQrisFile').value = '';
      document.getElementById('btnSubmitModal').textContent = 'Simpan Data Acara';

      document.getElementById('adminatorAcaraModal').style.display = 'flex';
    }

    function openEditAcaraModal(event) {
      document.getElementById('adminAcaraModalTitle').textContent = 'Edit Acara & QRIS Pembayaran';
      document.getElementById('inputEventTitle').value = event.title || '';
      document.getElementById('inputEventLocation').value = event.location || '';
      document.getElementById('inputEventDate').value = event.event_date ? event.event_date.substring(0, 10) : '';
      document.getElementById('inputMerchantName').value = event.qris_merchant_name || 'LIGHT AND GLOW BUKITTINGGI';
      document.getElementById('inputNmid').value = event.qris_nmid || '';
      document.getElementById('modalQrisFile').value = '';

      if (event.qris_image) {
        document.getElementById('modalQrisPreview').src = "{{ asset('') }}" + event.qris_image.replace(/^\/+/, '');
      } else {
        document.getElementById('modalQrisPreview').src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8';
      }

      document.getElementById('btnSubmitModal').textContent = 'Simpan Perubahan';
      document.getElementById('adminatorAcaraModal').style.display = 'flex';
    }

    function previewModalQris(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('modalQrisPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
