/* =========================================================
   main.js — Sam Incendie
   ========================================================= */

(function () {
  'use strict';

  /* ---- Burger / Mobile nav ---- */
  const burger = document.getElementById('burger');
  const nav    = document.querySelector('.nav');

  if (burger && nav) {
    burger.addEventListener('click', function () {
      const isOpen = nav.classList.toggle('open');
      burger.classList.toggle('open', isOpen);
      burger.setAttribute('aria-expanded', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    /* Close on nav link click */
    nav.querySelectorAll('.nav__link').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('open');
        burger.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    });

    /* Close on outside click */
    document.addEventListener('click', function (e) {
      if (nav.classList.contains('open') && !nav.contains(e.target) && !burger.contains(e.target)) {
        nav.classList.remove('open');
        burger.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  /* ---- Header scroll class ---- */
  const header = document.getElementById('header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ---- Back to top ---- */
  const btt = document.querySelector('.back-to-top');
  if (btt) {
    window.addEventListener('scroll', function () {
      btt.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    btt.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---- FAQ accordion ---- */
  document.querySelectorAll('.faq__question').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const item = btn.closest('.faq__item');
      const isOpen = item.classList.contains('open');
      /* Close all */
      document.querySelectorAll('.faq__item.open').forEach(function (el) {
        el.classList.remove('open');
      });
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ---- Scroll reveal ---- */
  if ('IntersectionObserver' in window) {
    const revealObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(function (el) {
      revealObs.observe(el);
    });
  } else {
    document.querySelectorAll('.reveal').forEach(function (el) {
      el.classList.add('visible');
    });
  }

  /* ---- Animated counters (stat-card__number) ---- */
  function animateCounter(el) {
    const raw    = el.textContent.trim();
    const target = parseFloat(raw.replace(/[^0-9.]/g, ''));
    if (isNaN(target)) return;
    const suffix   = raw.replace(/[0-9.]/g, '');
    const duration = 1600;
    const start    = performance.now();

    function step(now) {
      const elapsed  = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased    = 1 - Math.pow(1 - progress, 3);
      const value    = target * eased;
      el.textContent = (Number.isInteger(target) ? Math.round(value) : value.toFixed(1)) + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  if ('IntersectionObserver' in window) {
    const counterObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-card__number').forEach(function (el) {
      counterObs.observe(el);
    });
  }

  /* ---- Active nav link ---- */
  (function () {
    const path = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav__link').forEach(function (link) {
      const href = (link.getAttribute('href') || '').split('/').pop();
      if (href === path || (path === '' && href === 'index.html')) {
        link.classList.add('nav__link--active');
      }
    });
  })();

})();
