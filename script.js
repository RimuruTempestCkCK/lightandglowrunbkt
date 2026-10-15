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

// Modal Details Logic
function showTicketDetail(title, price, date, location, imgUrl, category) {
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

function closeTicketModal() {
  const modal = document.getElementById('ticketModal');
  if (modal) {
    modal.classList.remove('active');
  }
}

function closeModalOnOverlay(e) {
  if (e.target && e.target.id === 'ticketModal') {
    closeTicketModal();
  }
}

function proceedCheckout() {
  alert('Terima kasih! Anda akan diarahkan ke pemilihan metode pembayaran aman GOERS (BCA/QRIS/GoPay/Mandiri).');
  closeTicketModal();
}

function openLoginModal(action) {
  const msg = action ? `Silakan masuk untuk ${action}` : 'Masuk atau Buat Akun GOERS baru';
  alert(`${msg}\n\nFitur akun memungkinkan Anda melihat e-tiket tersimpan, riwayat order, dan membuat meetup di Crowd.`);
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
