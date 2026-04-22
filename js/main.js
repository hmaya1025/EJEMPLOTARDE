// ── NAVBAR SCROLL ──
const navbar = document.getElementById('navbar');
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
});

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  navLinks.classList.toggle('open');
  document.body.style.overflow = navLinks.classList.contains('open') ? 'hidden' : '';
});

navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    hamburger.classList.remove('active');
    navLinks.classList.remove('open');
    document.body.style.overflow = '';
  });
});

// ── SCROLL REVEAL ──
const revealEls = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      observer.unobserve(e.target);
    }
  });
}, { threshold: 0.12 });

revealEls.forEach(el => observer.observe(el));

// ── SMOOTH SCROLL ──
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const offset = 80;
      window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
    }
  });
});

// ── ALERT AUTO-CLOSE ──
const alertEl = document.querySelector('.alert');
if (alertEl) {
  setTimeout(() => {
    alertEl.style.transition = 'opacity .5s ease, transform .5s ease';
    alertEl.style.opacity = '0';
    alertEl.style.transform = 'translateX(60px)';
    setTimeout(() => alertEl.remove(), 500);
  }, 5000);

  const closeBtn = alertEl.querySelector('.alert-close');
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      alertEl.style.transition = 'opacity .3s ease, transform .3s ease';
      alertEl.style.opacity = '0';
      alertEl.style.transform = 'translateX(60px)';
      setTimeout(() => alertEl.remove(), 300);
    });
  }
}

// ── PRODUCT SELECT → FORM HIGHLIGHT ──
const selectProducto = document.getElementById('producto');
if (selectProducto) {
  const colorMap = {
    'Pulpa Roja':    '#D94040',
    'Pulpa Verde':   '#3DAA62',
    'Pulpa Amarilla':'#c9a200'
  };
  selectProducto.addEventListener('change', () => {
    const col = colorMap[selectProducto.value] || '#D94040';
    document.querySelectorAll('.form-group input, .form-group select, .form-group textarea').forEach(el => {
      el.style.setProperty('--focus-color', col);
    });
    document.querySelector('.btn-submit').style.background =
      `linear-gradient(135deg, ${col}, ${shadeColor(col, -20)})`;
  });
}

function shadeColor(hex, pct) {
  const num = parseInt(hex.slice(1), 16);
  const r = Math.min(255, Math.max(0, (num >> 16) + pct));
  const g = Math.min(255, Math.max(0, ((num >> 8) & 0xff) + pct));
  const b = Math.min(255, Math.max(0, (num & 0xff) + pct));
  return '#' + [r,g,b].map(v => v.toString(16).padStart(2,'0')).join('');
}

// ── SCROLL TO PEDIDO ON CARD BUTTON ──
document.querySelectorAll('.btn-card').forEach(btn => {
  btn.addEventListener('click', () => {
    const prod = btn.dataset.producto;
    if (prod && selectProducto) {
      selectProducto.value = prod;
      selectProducto.dispatchEvent(new Event('change'));
    }
    const pedidoSection = document.getElementById('pedido');
    if (pedidoSection) {
      window.scrollTo({ top: pedidoSection.offsetTop - 80, behavior: 'smooth' });
    }
  });
});

// ── FORM VALIDATION ──
const form = document.getElementById('pedidoForm');
if (form) {
  form.addEventListener('submit', e => {
    let valid = true;
    form.querySelectorAll('[required]').forEach(field => {
      field.style.borderColor = '';
      if (!field.value.trim()) {
        field.style.borderColor = '#D94040';
        valid = false;
      }
    });

    const tel = form.querySelector('#telefono');
    if (tel && tel.value && !/^[\d\s\+\-\(\)]{7,15}$/.test(tel.value)) {
      tel.style.borderColor = '#D94040';
      valid = false;
    }

    const email = form.querySelector('#correo');
    if (email && email.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
      email.style.borderColor = '#D94040';
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      const firstInvalid = form.querySelector('[style*="D94040"]');
      if (firstInvalid) firstInvalid.focus();
    }
  });
}
