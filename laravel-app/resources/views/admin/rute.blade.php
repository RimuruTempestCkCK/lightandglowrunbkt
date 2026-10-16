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
  <title>Master Rute & Spot Ikonik · Light And Glow Bukittinggi</title>
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
    .spot-table-wrap {
      overflow-x: auto;
      background: var(--bg-card);
      border-radius: 12px;
      border: 1px solid var(--border-soft);
      padding: 20px;
    }
    .thumb-spot {
      width: 80px;
      height: 52px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid var(--border-soft);
    }
    .btn-action-group {
      display: flex;
      gap: 6px;
      justify-content: flex-end;
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
  </style>
</head>
<body data-active="rute_direct" data-crumbs="Master Data | Rute & Spot Ikonik">
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
            <h1 class="hero-title">Kelola <span class="accent">Rute & Spot Ikonik</span></h1>
            <p class="hero-sub">Kelola nama spot, deskripsi aktivitas/rute, dan link foto lokasi yang tampil pada bagian <strong>"Rute & Venue Event"</strong> di Halaman Utama.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--primary" onclick="openAddSpotModal()">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Tambah Spot Baru
            </button>
          </div>
        </section>

        <!-- Table Master Spot Rute -->
        <div class="spot-table-wrap">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Data Database Terkini</span>
              <h2 class="card-title">Daftar Spot Ikonik Bukittinggi (Rute & Venue)</h2>
            </div>
          </div>

          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th style="width: 90px;">Foto Spot</th>
                <th>Nama Spot</th>
                <th>Keterangan / Aktivitas</th>
                <th style="width: 80px; text-align:center;">Urutan</th>
                <th style="text-align: right; width: 140px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($spots as $s)
                <tr>
                  <td>
                    <img src="{{ $s->image }}" class="thumb-spot" alt="{{ $s->name }}">
                  </td>
                  <td>
                    <strong style="font-size:14px; color:var(--t-base);">{{ $s->name }}</strong>
                    <span style="font-size:11px; color:var(--text-sub); display:block;">ID Spot: #{{ $s->id }}</span>
                  </td>
                  <td>
                    <span style="font-size:13px; color:var(--t-base); font-weight:500;">{{ $s->description }}</span>
                  </td>
                  <td style="text-align:center;">
                    <span class="tag" style="background:rgba(0,180,216,0.12); color:#00B4D8; font-weight:700; padding:2px 8px; border-radius:4px;">
                      #{{ $s->order_index }}
                    </span>
                  </td>
                  <td style="text-align: right;">
                    <div class="btn-action-group">
                      <button class="btn btn--ghost" style="padding:5px 10px; font-size:12px;" onclick='openEditSpotModal(@json($s))'>
                        Edit
                      </button>
                      <button class="btn btn--ghost" style="padding:5px 10px; font-size:12px; color:var(--danger);" onclick="confirmDeleteSpot({{ $s->id }}, '{{ addslashes($s->name) }}')">
                        Hapus
                      </button>
                    </div>
                    <!-- Form Delete Hidden -->
                    <form id="delete-spot-form-{{ $s->id }}" action="{{ route('admin.rute.delete', $s->id) }}" method="POST" style="display:none;">
                      @csrf
                      @method('DELETE')
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" style="text-align:center; padding:32px; color:var(--text-sub);">
                    Belum ada spot rute di database MySQL. Silakan klik tombol "Tambah Spot Baru".
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </main>
      <div data-shell-footer></div>
    </div>
  </div>

  <!-- Adminator Modal (Create / Edit) -->
  <div id="adminatorSpotModal" class="adminator-modal-overlay" style="display:none;" onclick="if(event.target===this)closeSpotModal()">
    <div class="adminator-modal" style="max-width:540px; width:92%;">
      <form id="modalSpotForm" method="POST" action="{{ route('admin.rute.store') }}">
        @csrf
        <div class="adminator-modal-head">
          <h3 id="spotModalTitle" class="adminator-modal-title">Tambah Spot Ikonik Baru</h3>
          <button type="button" class="adminator-modal-close" onclick="closeSpotModal()" aria-label="Tutup">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="adminator-modal-body">
          <div style="display:flex; flex-direction:column; gap:14px;">
            <div>
              <label class="field-label">Nama Spot Ikonik <span class="req">*</span></label>
              <input id="inputSpotName" name="name" class="input" placeholder="Contoh: Jam Gadang atau Ngarai Sianok" required>
            </div>
            
            <div>
              <label class="field-label">Deskripsi / Peran Spot <span class="req">*</span></label>
              <input id="inputSpotDesc" name="description" class="input" placeholder="Contoh: Start & Finish / Main Stage" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 100px; gap:12px;">
              <div>
                <label class="field-label">URL / File Foto Spot <span class="req">*</span></label>
                <input id="inputSpotImg" name="image" class="input" placeholder="https://images.unsplash.com/..." required oninput="previewSpotImg(this.value)">
              </div>
              <div>
                <label class="field-label">Urutan</label>
                <input id="inputSpotOrder" name="order_index" type="number" min="0" class="input" value="1">
              </div>
            </div>

            <!-- Preview Gambar -->
            <div>
              <label class="field-label">Preview Foto</label>
              <div style="border:1px dashed var(--border); border-radius:8px; padding:8px; text-align:center; background:var(--bg-body);">
                <img id="spotImgPreview" src="" alt="Preview" style="max-height:140px; max-width:100%; border-radius:6px; object-fit:cover; display:none; margin:0 auto;">
                <span id="spotImgPlaceholder" style="font-size:12px; color:var(--text-sub);">Masukkan URL foto untuk melihat preview</span>
              </div>
            </div>
          </div>
        </div>
        <div class="adminator-modal-foot">
          <button type="button" class="btn btn--ghost" onclick="closeSpotModal()">Batal</button>
          <button type="submit" class="btn btn--primary" id="btnSubmitSpot">Simpan ke Database</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function previewSpotImg(url) {
      const img = document.getElementById('spotImgPreview');
      const placeholder = document.getElementById('spotImgPlaceholder');
      if (url && url.trim().length > 5) {
        img.src = url;
        img.style.display = 'block';
        placeholder.style.display = 'none';
      } else {
        img.style.display = 'none';
        placeholder.style.display = 'inline';
      }
    }

    function closeSpotModal() {
      document.getElementById('adminatorSpotModal').style.display = 'none';
    }

    function openAddSpotModal() {
      const form = document.getElementById('modalSpotForm');
      form.action = "{{ route('admin.rute.store') }}";
      
      document.getElementById('spotModalTitle').textContent = 'Tambah Spot Ikonik Baru';
      document.getElementById('inputSpotName').value = '';
      document.getElementById('inputSpotDesc').value = '';
      document.getElementById('inputSpotImg').value = '';
      document.getElementById('inputSpotOrder').value = '1';
      document.getElementById('btnSubmitSpot').textContent = 'Simpan ke Database';

      previewSpotImg('');
      document.getElementById('adminatorSpotModal').style.display = 'flex';
    }

    function openEditSpotModal(spot) {
      const form = document.getElementById('modalSpotForm');
      form.action = "/admin/rute/" + spot.id + "/update";

      document.getElementById('spotModalTitle').textContent = 'Edit Spot #' + spot.id + ' (' + spot.name + ')';
      document.getElementById('inputSpotName').value = spot.name || '';
      document.getElementById('inputSpotDesc').value = spot.description || '';
      document.getElementById('inputSpotImg').value = spot.image || '';
      document.getElementById('inputSpotOrder').value = spot.order_index || '0';
      document.getElementById('btnSubmitSpot').textContent = 'Simpan Perubahan';

      previewSpotImg(spot.image || '');
      document.getElementById('adminatorSpotModal').style.display = 'flex';
    }

    function confirmDeleteSpot(id, name) {
      Swal.fire({
        title: 'Hapus Spot Rute?',
        text: `Apakah Anda yakin ingin menghapus spot "${name}"? Data di database MySQL akan dihapus permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-spot-form-' + id).submit();
        }
      });
    }
  </script>
</body>
</html>
