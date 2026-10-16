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
  <title>Laporan Kehadiran & Check-in · Light And Glow Bukittinggi</title>
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
    .filter-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 20px;
      align-items: center;
      justify-content: space-between;
      background: var(--bg-card);
      border: 1px solid var(--border-soft);
      border-radius: 12px;
      padding: 14px 18px;
    }
    .filter-group {
      display: flex;
      gap: 8px;
      align-items: center;
      flex-wrap: wrap;
    }
    @media print {
      body * { visibility: hidden; }
      #printableArea, #printableArea * { visibility: visible; }
      #printableArea { position: absolute; left: 0; top: 0; width: 100%; }
      .no-print { display: none !important; }
    }
  </style>
</head>
<body data-active="kehadiran" data-crumbs="Laporan & Petugas | Log Kehadiran">
  <div class="shell">
    <div data-shell-sidebar class="no-print"></div>
    <div class="main">
      <div data-shell-topbar class="no-print"></div>
      <main class="content">
        
        <!-- Hero Section (Bersih tanpa tombol scanner QR) -->
        <section class="hero no-print" style="margin-bottom: 24px;">
          <div class="hero-text">
            <span class="eyebrow">Audit & Kehadiran</span>
            <h1 class="hero-title">Laporan <span class="accent">Kehadiran Peserta</span></h1>
            <p class="hero-sub">Pantau riwayat pemindaian tiket di gate masuk. Filter status validasi atau cari kode tiket, serta unduh atau cetak laporan sesuai hasil filter.</p>
          </div>
          <div class="hero-actions">
            <button class="btn btn--ghost" onclick="exportAttendanceCSV()">
              <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Ekspor CSV
            </button>
            <button class="btn btn--primary" onclick="window.print()">
              <svg viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg>
              Cetak PDF Laporan
            </button>
          </div>
        </section>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar no-print">
          <div class="filter-group">
            <label style="font-size:12px; font-weight:700; color:var(--t-muted);">Status Validasi:</label>
            <select id="validationFilter" class="select" style="width: auto; padding: 7px 32px 7px 12px; font-size:13px;" onchange="applyAttendanceFilter()">
              <option value="ALL">Semua Hasil Scan</option>
              <option value="success">✓ Berhasil Masuk (Valid)</option>
              <option value="rejected_used">✕ Ditolak (Sudah Digunakan)</option>
              <option value="rejected_invalid">✕ Ditolak (Tidak Valid)</option>
            </select>
          </div>

          <div class="filter-group" style="flex:1; max-width:380px;">
            <div class="input-icon" style="width:100%;">
              <span class="ico">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              </span>
              <input type="text" id="attendanceSearch" class="input" placeholder="Cari nama peserta, kode tiket, gate..." oninput="applyAttendanceFilter()">
            </div>
          </div>
        </div>

        <!-- Table Kehadiran -->
        <div class="card" id="printableArea" style="padding: 24px;">
          <div class="card-head" style="margin-bottom: 16px;">
            <div class="card-title-wrap">
              <span class="eyebrow">Log Audit Real-time</span>
              <h2 class="card-title">Riwayat Check-in Peserta di Venue Acara</h2>
            </div>
            <div style="font-size:12px; color:var(--t-muted);" id="counterInfo">
              Menampilkan {{ count($logs) }} data kehadiran
            </div>
          </div>

          <table class="table" style="width: 100%;" id="attendanceTable">
            <thead>
              <tr>
                <th>Waktu Scan</th>
                <th>Kode Tiket / Token</th>
                <th>Nama Peserta</th>
                <th>Lokasi Gate</th>
                <th>Petugas Scan</th>
                <th>Status Validasi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($logs as $log)
                <tr class="attendance-row"
                    data-time="{{ $log->scanned_at }}"
                    data-code="{{ $log->ticket_code }}"
                    data-name="{{ $log->holder_name }}"
                    data-gate="{{ $log->gate_location }}"
                    data-staff="{{ $log->staff_name ?? 'Petugas Gate' }}"
                    data-status="{{ $log->validation_status }}"
                    data-search="{{ strtolower($log->ticket_code . ' ' . $log->holder_name . ' ' . $log->gate_location . ' ' . ($log->staff_name ?? '')) }}">
                  <td>
                    <strong>{{ \Carbon\Carbon::parse($log->scanned_at)->format('H:i') }} WIB</strong><br>
                    <small style="color:var(--t-muted);">{{ \Carbon\Carbon::parse($log->scanned_at)->format('d M Y') }}</small>
                  </td>
                  <td>
                    <code style="background:var(--bg-muted); padding:3px 7px; border-radius:4px; font-weight:600;">
                      {{ $log->ticket_code }}
                    </code>
                  </td>
                  <td>
                    <strong style="color:var(--t-base);">{{ $log->holder_name }}</strong>
                  </td>
                  <td>{{ $log->gate_location }}</td>
                  <td>
                    <span style="font-size:12.5px; color:var(--t-muted);">{{ $log->staff_name ?? 'Petugas Scanner' }}</span>
                  </td>
                  <td>
                    @if($log->validation_status === 'success')
                      <span class="tag t-success" style="background:rgba(16,185,129,0.2); color:#10B981; padding:3px 8px; border-radius:4px; font-weight:700;">
                        ✓ Check-in Berhasil
                      </span>
                    @elseif($log->validation_status === 'rejected_used')
                      <span class="tag t-danger" style="background:rgba(235,19,85,0.2); color:#EB1355; padding:3px 8px; border-radius:4px; font-weight:700;">
                        ✕ Ditolak: Tiket Sudah Dipakai
                      </span>
                    @else
                      <span class="tag t-danger" style="background:rgba(235,19,85,0.2); color:#EB1355; padding:3px 8px; border-radius:4px; font-weight:700;">
                        ✕ Ditolak: Tidak Valid
                      </span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" style="text-align:center; padding:32px; color:var(--t-muted);">
                    Belum ada riwayat check-in pemindaian tiket di gate masuk.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div id="noMatchMessage" style="display:none; text-align:center; padding:30px; color:var(--t-muted);">
            Tidak ditemukan data kehadiran yang sesuai dengan filter atau pencarian.
          </div>
        </div>

      </main>
      <div data-shell-footer class="no-print"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function applyAttendanceFilter() {
      const status = document.getElementById('validationFilter').value;
      const query = document.getElementById('attendanceSearch').value.toLowerCase().trim();
      const rows = document.querySelectorAll('.attendance-row');
      let visibleCount = 0;

      rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const rowSearch = row.getAttribute('data-search') || '';

        const matchesStatus = (status === 'ALL') || (rowStatus === status);
        const matchesQuery = !query || rowSearch.includes(query);

        if (matchesStatus && matchesQuery) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      const noMatch = document.getElementById('noMatchMessage');
      if (visibleCount === 0 && rows.length > 0) {
        noMatch.style.display = 'block';
      } else {
        noMatch.style.display = 'none';
      }

      document.getElementById('counterInfo').textContent = `Menampilkan ${visibleCount} data kehadiran`;
    }

    function exportAttendanceCSV() {
      const rows = Array.from(document.querySelectorAll('.attendance-row')).filter(r => r.style.display !== 'none');
      if (rows.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Data Kosong', text: 'Tidak ada data kehadiran yang tampil untuk diekspor.' });
        return;
      }

      let csv = 'Waktu Scan,Kode Tiket,Nama Peserta,Lokasi Gate,Petugas Scan,Status Validasi\n';

      rows.forEach(r => {
        const time = `"${r.getAttribute('data-time')}"`;
        const code = `"${r.getAttribute('data-code')}"`;
        const name = `"${r.getAttribute('data-name')}"`;
        const gate = `"${r.getAttribute('data-gate')}"`;
        const staff = `"${r.getAttribute('data-staff')}"`;
        const status = `"${r.getAttribute('data-status')}"`;

        csv += `${time},${code},${name},${gate},${staff},${status}\n`;
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', `laporan_kehadiran_${new Date().toISOString().slice(0,10)}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  </script>
</body>
</html>
