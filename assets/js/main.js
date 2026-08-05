/* gt — 主题交互 */
(function () {
  'use strict';

  var doc = document;

  /* 1. 滚动后显示固定顶栏 */
  var rh = doc.getElementById('rh');
  function onScroll() {
    if (rh) {
      if (window.scrollY > 60) {
        rh.classList.add('show');
      } else {
        rh.classList.remove('show');
      }
    }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* 2. 滚动显现动画 */
  var reveal = doc.querySelectorAll('.rv, .rv-s');
  if ('IntersectionObserver' in window && reveal.length) {
    var ro = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('vis');
          ro.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    reveal.forEach(function (el) {
      ro.observe(el);
    });
  } else {
    reveal.forEach(function (el) {
      el.classList.add('vis');
    });
  }

  /* 3. 移动端搜索框展开 */
  var searchWrap = doc.getElementById('rhSearch');
  var searchBtn = doc.getElementById('rhSearchBtn');
  var searchInput = doc.getElementById('rhSearchInput');
  if (searchWrap && searchBtn && searchInput) {
    searchBtn.addEventListener('click', function (e) {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        var open = searchWrap.classList.toggle('open');
        if (open) {
          searchInput.focus();
        }
      }
    });
    doc.addEventListener('click', function (e) {
      if (window.innerWidth <= 768 && searchWrap.classList.contains('open') && !searchWrap.contains(e.target)) {
        searchWrap.classList.remove('open');
      }
    });
  }

  /* 4. 回到顶部 */
  var backTop = doc.getElementById('backTop');
  if (backTop) {
    backTop.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }


  /* 6. 暗色模式：默认跟随系统，滑块手动切换（记忆在 localStorage） */
  var themeToggle = doc.getElementById('themeToggle');
  function applyTheme(mode) {
    doc.body.classList.remove('gt-dark', 'gt-light');
    if (mode === 'dark') {
      doc.body.classList.add('gt-dark');
    } else if (mode === 'light') {
      doc.body.classList.add('gt-light');
    }
    if (themeToggle) {
      var isDark = mode === 'dark' || (mode === null && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
      themeToggle.classList.toggle('on', isDark);
      themeToggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
    }
  }
  var storedTheme = null;
  try { storedTheme = localStorage.getItem('gt-theme'); } catch (e) { storedTheme = null; }
  applyTheme(storedTheme);
  if (themeToggle) {
    themeToggle.addEventListener('click', function () {
      var isDark = !themeToggle.classList.contains('on');
      try { localStorage.setItem('gt-theme', isDark ? 'dark' : 'light'); } catch (e) {}
      applyTheme(isDark ? 'dark' : 'light');
    });
  }
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
      var cur = null;
      try { cur = localStorage.getItem('gt-theme'); } catch (e) {}
      if (!cur) { applyTheme(null); }
    });
  }
  /* 5. 代码高亮（highlight.js 自托管） */
  function initHighlight() {
    if (doc.querySelector('pre code') && window.hljs) {
      try {
        window.hljs.configure({ ignoreUnescapedHTML: true });
        window.hljs.highlightAll();
      } catch (err) {
        /* 高亮失败不影响页面阅读 */
      }
    }
  }
  if (doc.readyState === 'loading') {
    doc.addEventListener('DOMContentLoaded', initHighlight);
  } else {
    initHighlight();
  }
})();
