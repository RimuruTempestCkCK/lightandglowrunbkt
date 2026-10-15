// Initialize Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) {
    lucide.createIcons();
  }
});

// Hero Carousel Logic
let currentSlide = 0;
const heroSlider = document.getElementById('heroSlider');
const dots = document.querySelectorAll('.slider-dot');
const totalSlides = 3;
let autoSlideInterval = setInterval(() => slideHero(1), 5000);

function updateSlider() {
  if (!heroSlider) return;
  heroSlider.style.transform = `translateX(-${currentSlide * 100}%)`;
  dots.forEach((dot, idx) => {
    dot.classList.toggle('active', idx === currentSlide);
  });
}

function slideHero(direction) {
  currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
  updateSlider();
  resetAutoSlide();
}

function goToSlide(index) {
  currentSlide = index;
  updateSlider();
  resetAutoSlide();
}

function resetAutoSlide() {
  clearInterval(autoSlideInterval);
  autoSlideInterval = setInterval(() => slideHero(1), 5000);
}

let currentSelectedTicket = {
  id: 1,
  title: 'Early Bird - Festival Pass',
  price: 'Rp 99.000',
  date: '25 Apr 2026',
  location: 'Jam Gadang, Bukittinggi',
  imgUrl: '',
  category: 'Festival Run'
};

function showTicketDetail(title, price, date, location, imgUrl, category, id) {
  currentSelectedTicket = { title, price, date, location, imgUrl, category, id: id || 1 };

  document.getElementById('modalTitle').textContent = 'Pemesanan Tiket';
  document.getElementById('modalEventName').textContent = title;
  document.getElementById('modalPrice').textContent = price;
  document.getElementById('modalDate').textContent = date;
  document.getElementById('modalLocation').textContent = location;
  document.getElementById('modalCategory').textContent = category;
  document.getElementById('modalImg').src = imgUrl;
  
  const modal = document.getElementById('ticketModal');
  if (modal) {
    modal.classList.add('active');
  }
  if (window.lucide) {
    lucide.createIcons();
  }
}

function proceedCheckout() {
  closeTicketModal();

  // Langkah 2: Mengisi data pembeli
  Swal.fire({
    title: 'Data Diri Pembeli Tiket',
    html: `
      <div style="text-align:left; font-size:13px; display:flex; flex-direction:column; gap:10px;">
        <div style="background:#F1F5F9; padding:10px; border-radius:8px;">
          <div style="font-weight:700; color:#0F172A;">${currentSelectedTicket.title}</div>
          <div style="color:#EB1355; font-weight:800; font-size:15px; margin-top:2px;">${currentSelectedTicket.price}</div>
        </div>
        <div>
          <label><b>Nama Lengkap Sesuai KTP/Identitas:</b></label>
          <input id="swal-cust-name" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: Rian Hidayat">
        </div>
        <div>
          <label><b>Alamat Email Aktif (Untuk Pengiriman E-Tiket):</b></label>
          <input id="swal-cust-email" type="email" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: rian@email.com">
        </div>
        <div>
          <label><b>Nomor WhatsApp:</b></label>
          <input id="swal-cust-phone" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: 081234567890">
        </div>
        <div>
          <label><b>Nomor Identitas (NIK KTP / Pelajar):</b></label>
          <input id="swal-cust-nik" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: 1375012304950001">
        </div>
      </div>
    `,
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonColor: '#EB1355',
    confirmButtonText: 'Lanjut ke Pembayaran QRIS →',
    cancelButtonText: 'Batal',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      const name = document.getElementById('swal-cust-name').value;
      const email = document.getElementById('swal-cust-email').value;
      const phone = document.getElementById('swal-cust-phone').value;
      const nik = document.getElementById('swal-cust-nik').value;

      if (!name || !email || !phone) {
        Swal.showValidationMessage('Nama, email, dan no. WhatsApp wajib diisi!');
        return false;
      }

      // Kirim data ke API backend Laravel
      return fetch('/api/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          ticket_type_id: currentSelectedTicket.id || currentSelectedTicket.title,
          name: name,
          email: email,
          phone: phone,
          nik: nik,
          quantity: 1,
          payment_method: 'QRIS BCA'
        })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Gagal memproses pemesanan tiket');
        }
        return response.json();
      })
      .then(data => {
        return { name, email, phone, nik, orderData: data };
      })
      .catch(error => {
        Swal.showValidationMessage(`Gagal checkout: ${error}`);
      });
    }
  }).then((res) => {
    if (res.isConfirmed && res.value && res.value.orderData) {
      showPaymentStep(res.value.orderData, res.value);
    }
  });
}

function showPaymentStep(orderData, buyer) {
  const orderNumber = orderData.order_number;
  const qrImage = orderData.qris_image_url || `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(orderData.qris_payload)}`;

  // Langkah 5: Menampilkan QRIS beserta nominal pembayaran
  Swal.fire({
    title: `Pembayaran QRIS ${orderNumber}`,
    html: `
      <div style="text-align:center; padding:5px;">
        <div style="font-size:13px; color:#64748B; margin-bottom:8px;">
          Pesanan atas nama: <b>${buyer.name}</b> (${buyer.email})
        </div>
        <div style="font-size:12px; color:#475569; margin-bottom:12px;">
          Tiket: <b>${orderData.ticket_name || currentSelectedTicket.title}</b>
        </div>
        <div style="background:#FFF1F2; border:1px solid #FECDD3; border-radius:10px; padding:10px; margin-bottom:14px;">
          <span style="font-size:12px; color:#9F1239;">Total yang harus dibayar:</span>
          <div style="font-size:24px; font-weight:900; color:#EB1355;">${orderData.total_formatted || currentSelectedTicket.price}</div>
        </div>

        <div style="background:#fff; border:2px solid #E2E8F0; border-radius:12px; padding:14px; display:inline-block; margin-bottom:10px; box-shadow:0 4px 12px rgba(0,0,0,0.06);">
          <img src="${qrImage}" style="width:190px; height:190px;" alt="QRIS Light and Glow">
          <div style="font-size:11px; font-weight:700; color:#0F172A; margin-top:8px; letter-spacing:0.05em;">QRIS STANDAR PEMBAYARAN NASIONAL</div>
          <div style="font-size:10px; color:#64748B;">BCA / Mandiri / BRI / BNI / GoPay / OVO / ShopeePay / Dana</div>
        </div>

        <div style="text-align:left; font-size:12px; color:#475569; background:#F8FAFC; padding:10px 14px; border-radius:8px; margin-top:10px; line-height:1.5;">
          <b>Petunjuk Pembayaran:</b><br>
          1. Buka aplikasi m-Banking atau e-Wallet favorit Anda.<br>
          2. Scan QRIS di atas dan selesaikan transfer sejumlah <b>${orderData.total_formatted || currentSelectedTicket.price}</b>.<br>
          3. Simpan tangkapan layar (screenshot) bukti pembayaran Anda.
        </div>
      </div>
    `,
    showCancelButton: true,
    confirmButtonColor: '#EB1355',
    confirmButtonText: 'Saya Sudah Bayar (Unggah Bukti) 📤',
    cancelButtonText: 'Tutup / Bayar Nanti'
  }).then((res) => {
    if (res.isConfirmed) {
      showUploadProofStep(orderData, buyer);
    }
  });
}

function showUploadProofStep(orderData, buyer) {
  const orderId = orderData.order_id;
  const orderNumber = orderData.order_number;

  // Langkah 7: Pembeli mengunggah bukti pembayaran
  Swal.fire({
    title: `Unggah Bukti Bayar`,
    html: `
      <div style="text-align:left; font-size:13px; display:flex; flex-direction:column; gap:10px;">
        <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:8px; padding:10px; color:#166534;">
          Nomor Pesanan: <b>${orderNumber}</b><br>
          Nominal: <b>${orderData.total_formatted || currentSelectedTicket.price}</b>
        </div>
        <div>
          <label><b>Pilih File Foto Bukti Transfer / Resi QRIS:</b></label>
          <input type="file" id="swal-proof-file" accept="image/*" class="swal2-file" style="margin:8px 0 0; width:100%;">
        </div>
        <div>
          <label><b>Catatan Tambahan (Opsional):</b></label>
          <input id="swal-proof-note" class="swal2-input" style="width:100%; margin:4px 0 0;" placeholder="Contoh: Transfer atas nama ${buyer.name}">
        </div>
      </div>
    `,
    showCancelButton: true,
    confirmButtonColor: '#10B981',
    confirmButtonText: 'Kirim Bukti Pembayaran',
    cancelButtonText: 'Batal',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      const fileInput = document.getElementById('swal-proof-file');
      if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        Swal.showValidationMessage('Silakan pilih file bukti transfer Anda!');
        return false;
      }

      const note = document.getElementById('swal-proof-note').value;
      const formData = new FormData();
      formData.append('payment_proof', fileInput.files[0]);
      formData.append('note', note);

      return fetch(`/api/orders/${orderId}/upload-proof`, {
        method: 'POST',
        headers: {
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Gagal mengunggah bukti pembayaran');
        }
        return response.json();
      })
      .catch(error => {
        Swal.showValidationMessage(`Upload gagal: ${error}`);
      });
    }
  }).then((res) => {
    if (res.isConfirmed) {
      // Langkah 8: Pembeli menunggu verifikasi oleh admin
      Swal.fire({
        icon: 'success',
        title: 'Bukti Pembayaran Diterima!',
        html: `
          <div style="text-align:left; font-size:13px; line-height:1.6; color:#334155;">
            <p>Terima kasih <b>${buyer.name}</b>! Bukti pembayaran untuk pesanan <b>${orderNumber}</b> berhasil disimpan ke database sistem.</p>
            <div style="background:#FFFBEB; border:1px solid #FDE68A; border-radius:8px; padding:10px; margin:10px 0; color:#92400E;">
              <b>Status Pesanan:</b> <span style="font-weight:700; color:#D97706;">Menunggu Verifikasi Admin</span><br>
              Admin akan memverifikasi mutasi pembayaran Anda segera.
            </div>
            <p>Setelah disetujui, tiket digital ber-QR Code unik akan otomatis aktif dan dapat dilihat di menu <b>Tiket Saya</b>.</p>
          </div>
        `,
        confirmButtonColor: '#EB1355',
        confirmButtonText: 'Lihat Tiket Saya →'
      }).then(() => {
        window.location.href = '/tiket-saya';
      });
    }
  });
}

function openLoginModal(action) {
  const msg = action ? `Silakan masuk untuk ${action}` : 'Portal Akun Light and Glow Bukittinggi';
  Swal.fire({
    title: 'Akun Light & Glow',
    text: msg + '. Akses tiket digital Anda dan riwayat transaksi pemesanan tiket.',
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#EB1355',
    confirmButtonText: 'Menuju Login Admin',
    cancelButtonText: 'Tutup'
  }).then((res) => {
    if (res.isConfirmed) {
      window.location.href = '/login';
    }
  });
}

// Live Event Filter
function filterEvents(query) {
  const q = query.toLowerCase().trim();
  const cards = document.querySelectorAll('.event-card');
  cards.forEach(card => {
    const text = card.textContent.toLowerCase();
    if (text.includes(q)) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function filterByCategory(category) {
  const cards = document.querySelectorAll('.event-card');
  cards.forEach(card => {
    if (category === 'all' || card.getAttribute('data-category') === category) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function selectCategory(category, event) {
  if (event) event.preventDefault();
  document.querySelectorAll('.subnav-item').forEach(el => el.classList.remove('active'));
  if (event && event.currentTarget) {
    event.currentTarget.parentElement.classList.add('active');
  }
  filterByCategory(category);
}

function filterByCity(cityName) {
  const search = document.getElementById('mainSearchInput');
  if (search) {
    search.value = cityName;
  }
  filterEvents(cityName);
  const eventsSection = document.getElementById('eventsContainer');
  if (eventsSection) {
    eventsSection.scrollIntoView({ behavior: 'smooth' });
  }
}

// Mobile Drawer
function toggleMobileDrawer() {
  const drawer = document.getElementById('mobileDrawer');
  const overlay = document.getElementById('drawerOverlay');
  if (drawer && overlay) {
    drawer.classList.toggle('open');
    overlay.classList.toggle('active');
  }
}

// Cookie Banner
function acceptCookies() {
  const banner = document.getElementById('cookieBanner');
  if (banner) {
    banner.style.display = 'none';
  }
  localStorage.setItem('goers_cookie_accepted', 'true');
}

if (localStorage.getItem('goers_cookie_accepted') === 'true') {
  const cb = document.getElementById('cookieBanner');
  if (cb) cb.style.display = 'none';
}

// Newsletter Form
function handleSubscribe(e) {
  e.preventDefault();
  const el = document.getElementById('subSuccess');
  if (el) {
    el.style.display = 'block';
    setTimeout(() => {
      el.style.display = 'none';
    }, 4000);
  }
}
