// Initialize Lucide Icons + Hero Carousel + Cookie Banner on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) {
    lucide.createIcons();
  }

  // Initialize hero slider after DOM is ready
  initHeroSlider();

  // Cookie banner
  if (localStorage.getItem('goers_cookie_accepted') === 'true') {
    const cb = document.getElementById('cookieBanner');
    if (cb) cb.style.display = 'none';
  }
});

// Hero Carousel Logic
let currentSlide = 0;
let heroSlider = null;
let dots = [];
let totalSlides = 3;
let autoSlideInterval = null;

function initHeroSlider() {
  heroSlider = document.getElementById('heroSlider');
  dots = document.querySelectorAll('.slider-dot');
  const slideElements = document.querySelectorAll('.hero-slide');
  if (slideElements.length > 0) {
    totalSlides = slideElements.length;
  }
  if (heroSlider && totalSlides > 1) {
    autoSlideInterval = setInterval(() => slideHero(1), 5000);
  }
}

function updateSlider() {
  if (!heroSlider) return;
  heroSlider.style.transform = `translateX(-${currentSlide * 100}%)`;
  dots.forEach((dot, idx) => {
    dot.classList.toggle('active', idx === currentSlide);
  });
}

function slideHero(direction) {
  if (totalSlides <= 1) return;
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
  if (totalSlides > 1) {
    autoSlideInterval = setInterval(() => slideHero(1), 5000);
  }
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

function isBuyerLoggedIn() {
  const flag = document.body.getAttribute('data-buyer-logged-in');
  return flag === '1' || flag === 'true';
}

function openRequireLoginModal() {
  const modal = document.getElementById('requireLoginModal');
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  } else {
    window.location.href = document.body.getAttribute('data-login-url') || '/masuk';
  }
}

function closeRequireLoginModal(e) {
  if (e && e.target && e.target.id !== 'requireLoginModal') {
    return;
  }
  const modal = document.getElementById('requireLoginModal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

function switchBookingStep(step) {
  const steps = ['detail', 'form', 'payment', 'upload', 'success'];
  steps.forEach(s => {
    const el = document.getElementById('bookingStep' + s.charAt(0).toUpperCase() + s.slice(1));
    if (el) el.style.display = (s === step) ? 'flex' : 'none';
  });

  if (window.lucide) {
    lucide.createIcons();
  }
}

function showTicketDetail(title, price, date, location, imgUrl, category, id, quota) {
  // Wajib login dulu sebelum bisa memesan tiket
  if (!isBuyerLoggedIn()) {
    openRequireLoginModal();
    return;
  }

  // Jika tiket habis, jangan izinkan buka modal pemesanan
  if (quota !== undefined && quota !== null && parseInt(quota) <= 0) {
    alert('Maaf, kuota tiket ' + title + ' sudah habis terjual!');
    return;
  }

  currentSelectedTicket = { title, price, date, location, imgUrl, category, id: id || 1, quota: quota };

  document.getElementById('modalTitle').textContent = 'Pemesanan Tiket';
  document.getElementById('modalEventName').textContent = title;
  document.getElementById('modalPrice').textContent = price;
  document.getElementById('modalDate').textContent = date;
  document.getElementById('modalLocation').textContent = location;
  document.getElementById('modalCategory').textContent = category;
  document.getElementById('modalImg').src = imgUrl;

  const formNameEl = document.getElementById('formSelectedTicketName');
  const formPriceEl = document.getElementById('formSelectedTicketPrice');
  if (formNameEl) formNameEl.textContent = title;
  if (formPriceEl) formPriceEl.textContent = price;
  
  // Reset ke step pertama (detail)
  switchBookingStep('detail');

  const modal = document.getElementById('ticketModal');
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  if (window.lucide) {
    lucide.createIcons();
  }
}

function closeTicketModal() {
  const modal = document.getElementById('ticketModal');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

function closeModalOnOverlay(event) {
  if (event.target === document.getElementById('ticketModal')) {
    closeTicketModal();
  }
}

function proceedCheckout() {
  // Pengecekan login kembali untuk keamanan
  if (!isBuyerLoggedIn()) {
    closeTicketModal();
    openRequireLoginModal();
    return;
  }

  const errEl = document.getElementById('checkoutFormError');
  if (errEl) errEl.style.display = 'none';

  switchBookingStep('form');
}

let activeOrderData = null;
let activeBuyerData = null;

function submitCheckoutOrder(e) {
  e.preventDefault();

  if (!isBuyerLoggedIn()) {
    closeTicketModal();
    openRequireLoginModal();
    return;
  }

  const name = document.getElementById('custName').value.trim();
  const email = document.getElementById('custEmail').value.trim();
  const phone = document.getElementById('custPhone').value.trim();
  const nik = document.getElementById('custNik').value.trim();
  const btn = document.getElementById('btnSubmitCheckout');
  const errEl = document.getElementById('checkoutFormError');

  if (!name || !email || !phone) {
    if (errEl) {
      errEl.textContent = 'Nama, email, dan nomor WhatsApp wajib diisi!';
      errEl.style.display = 'block';
    }
    return;
  }

  if (btn) {
    btn.disabled = true;
    btn.innerHTML = 'Memproses Pesanan...';
  }

  fetch('/api/checkout', {
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
      payment_method: 'QRIS'
    })
  })
  .then(res => {
    if (!res.ok) {
      if (res.status === 401) {
        closeTicketModal();
        openRequireLoginModal();
        throw new Error('Sesi login telah berakhir. Silakan login kembali.');
      }
      return res.json().then(j => { throw new Error(j.message || 'Gagal membuat pesanan'); });
    }
    return res.json();
  })
  .then(data => {
    activeOrderData = data;
    activeBuyerData = { name, email, phone, nik };

    // Tampilkan data ke Step Pembayaran QRIS (Template)
    document.getElementById('payModalOrderNumber').textContent = `Pembayaran QRIS ${data.order_number}`;
    document.getElementById('payModalBuyerName').textContent = `${name} (${email})`;
    document.getElementById('payModalTicketName').textContent = data.ticket_name || currentSelectedTicket.title;
    document.getElementById('payModalTotalAmount').textContent = data.total_formatted || currentSelectedTicket.price;
    
    const qrUrl = data.qris_image_url || `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(data.qris_payload)}`;
    document.getElementById('payModalQrisImg').src = qrUrl;

    // Set data ke step upload
    document.getElementById('uploadOrderNumber').textContent = data.order_number;
    document.getElementById('uploadOrderTotal').textContent = data.total_formatted || currentSelectedTicket.price;

    switchBookingStep('payment');
  })
  .catch(err => {
    if (errEl) {
      errEl.textContent = err.message || 'Terjadi kesalahan sistem saat pemesanan.';
      errEl.style.display = 'block';
    }
  })
  .finally(() => {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = 'Lanjut ke Pembayaran QRIS →';
    }
  });
}

function previewProofImage(input) {
  const container = document.getElementById('proofPreviewContainer');
  const img = document.getElementById('proofPreviewImg');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      img.src = e.target.result;
      container.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    container.style.display = 'none';
  }
}

function submitPaymentProof(e) {
  e.preventDefault();

  if (!activeOrderData || !activeOrderData.order_id) {
    return;
  }

  const fileInput = document.getElementById('proofFileInput');
  const noteInput = document.getElementById('proofNoteInput');
  const errEl = document.getElementById('uploadFormError');
  const btn = document.getElementById('btnSubmitProof');

  if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
    if (errEl) {
      errEl.textContent = 'Silakan pilih foto bukti transfer atau bukti scan QRIS Anda!';
      errEl.style.display = 'block';
    }
    return;
  }

  const formData = new FormData();
  formData.append('payment_proof', fileInput.files[0]);
  formData.append('note', noteInput ? noteInput.value : '');

  if (btn) {
    btn.disabled = true;
    btn.innerHTML = 'Mengirim Bukti...';
  }

  fetch(`/api/orders/${activeOrderData.order_id}/upload-proof`, {
    method: 'POST',
    headers: {
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(res => {
    if (!res.ok) {
      return res.json().then(j => { throw new Error(j.message || 'Gagal mengunggah bukti pembayaran'); });
    }
    return res.json();
  })
  .then(() => {
    document.getElementById('successOrderNumber').textContent = activeOrderData.order_number;
    switchBookingStep('success');
  })
  .catch(err => {
    if (errEl) {
      errEl.textContent = err.message || 'Gagal mengirim bukti pembayaran.';
      errEl.style.display = 'block';
    }
  })
  .finally(() => {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = 'Kirim Bukti Pembayaran';
    }
  });
}

function openLoginModal(action) {
  openRequireLoginModal();
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
