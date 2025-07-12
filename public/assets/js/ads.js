function isInViewport(el) {
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

function trackImpressions() {
  document.querySelectorAll('.adnm-tag').forEach(ad => {
    if (ad.dataset.tracked === 'true') return;

    if (isInViewport(ad)) {
      ad.dataset.tracked = 'true';
      console.log('👁️ Tracking impression for:', ad);

      const formData = new FormData();
      const token = document.querySelector('meta[name="csrf-token"]').content;
      formData.append('_token', token);
      formData.append('action', 'impression');

      fetch('/track-impression', {
        method: 'POST',
        body: formData
      })
      .then(res => res.ok ? res.json() : Promise.reject(res))
      .then(data => console.log('✅ Impression logged:', data))
      .catch(err => console.error('❌ Impression tracking failed:', err));
    }
  });
}

// Track clicks on specific creatives by ID
const clickIds = [
  'adsm-iframe-midscroll_mobile_prebanner_placeholder-aaf8b3afb1',
  'adsm-iframe-aaf8b3afb1',
  'adsm-iframe-midscroll_mobile_postbanner_placeholder-aaf8b3afb1'
];

function attachClickTrackingById(id) {
  const el = document.getElementById(id);
  if (!el || el.dataset.clickTracked === 'true') return;

  el.dataset.clickTracked = 'true';

  el.addEventListener('click', () => {
    console.log('🖱️ Click tracked on element ID:', id);

    const formData = new FormData();
    const token = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('_token', token);
    formData.append('action', 'click');

    fetch('/track-impression', {
      method: 'POST',
      body: formData
    })
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => console.log('✅ Click tracked:', data))
    .catch(err => console.error('❌ Click tracking failed:', err));
  });
}

function initClickTracking() {
  clickIds.forEach(id => {
    const el = document.getElementById(id);
    if (el) {
      attachClickTrackingById(id);
    } else {
      // Watch for late-load
      const observer = new MutationObserver(() => {
        const lateEl = document.getElementById(id);
        if (lateEl) {
          attachClickTrackingById(id);
          observer.disconnect();
        }
      });
      observer.observe(document.body, { childList: true, subtree: true });
    }
  });
}

window.addEventListener('scroll', trackImpressions);
window.addEventListener('resize', trackImpressions);
window.addEventListener('load', function () {
  trackImpressions();
  initClickTracking();
});
