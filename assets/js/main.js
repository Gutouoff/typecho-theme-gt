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

  /* 3. 搜索框展开（点击触发，所有宽度） */
  var searchWrap = doc.getElementById('rhSearch');
  var searchBtn = doc.getElementById('rhSearchBtn');
  var searchInput = doc.getElementById('rhSearchInput');
  if (searchWrap && searchBtn && searchInput) {
    searchBtn.addEventListener('click', function (e) {
      e.preventDefault();
      var open = searchWrap.classList.toggle('open');
      searchBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) {
        searchInput.focus();
      }
    });
    doc.addEventListener('click', function (e) {
      if (searchWrap.classList.contains('open') && !searchWrap.contains(e.target)) {
        searchWrap.classList.remove('open');
        searchBtn.setAttribute('aria-expanded', 'false');
      }
    });
    searchInput.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        searchWrap.classList.remove('open');
        searchBtn.setAttribute('aria-expanded', 'false');
        searchBtn.focus();
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

  /* 7. 代码块一键复制 */
  function fallbackCopy(text) {
    var ta = doc.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.top = '0';
    ta.style.opacity = '0';
    doc.body.appendChild(ta);
    ta.select();
    try { doc.execCommand('copy'); } catch (e) {}
    doc.body.removeChild(ta);
  }
  function initCopyButtons() {
    var pres = doc.querySelectorAll('.entry-content pre');
    if (!pres.length) return;
    pres.forEach(function (pre) {
      if (pre.querySelector('.copy-btn')) return;
      var code = pre.querySelector('code');
      if (!code) return;
      var btn = doc.createElement('button');
      btn.type = 'button';
      btn.className = 'copy-btn';
      btn.setAttribute('aria-label', '复制代码');
      btn.textContent = 'COPY';
      btn.addEventListener('click', function () {
        var text = code.textContent || '';
        var markDone = function () {
          btn.textContent = 'COPIED';
          btn.classList.add('copied');
          setTimeout(function () {
            btn.textContent = 'COPY';
            btn.classList.remove('copied');
          }, 1600);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(text).then(markDone, function () {
            fallbackCopy(text);
            markDone();
          });
        } else {
          fallbackCopy(text);
          markDone();
        }
      });
      pre.appendChild(btn);
    });
  }

  function onReady() {
    initHighlight();
    initCopyButtons();
  }
  if (doc.readyState === 'loading') {
    doc.addEventListener('DOMContentLoaded', onReady);
  } else {
    onReady();
  }
})();
