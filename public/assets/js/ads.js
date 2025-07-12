// ✅ Impression Tracking
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

// ✅ Click Tracking
const clickTrackedElements = new WeakSet();

function attachClickObserver(el) {
  if (clickTrackedElements.has(el)) return;
  clickTrackedElements.add(el);

  el.addEventListener('click', function () {
    console.log('🖱️ Click tracked on .adnm-creative:', el);

    const formData = new FormData();
    const token = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('_token', token);
    formData.append('action', 'click');

    fetch('/track-impression', {
      method: 'POST',
      body: formData
    })
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => console.log('✅ Click logged:', data))
    .catch(err => console.error('❌ Click tracking failed:', err));
  }, true); // 👈 useCapture = true to avoid interfering with Adnami handlers
}

function bindClicksToAllCreatives() {
  document.querySelectorAll('.adnm-creative').forEach(el => {
    // Ensure only visible and interactive creatives are counted
    const style = window.getComputedStyle(el);
    if (style.display !== 'none' && style.visibility !== 'hidden' && el.offsetHeight > 30 && el.offsetWidth > 30) {
      attachClickObserver(el);
    }
  });
}

// ✅ Monitor DOM for dynamic creatives
function observeDynamicCreatives() {
  const observer = new MutationObserver(() => {
    bindClicksToAllCreatives();
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });
}

// ✅ Init on Load
window.addEventListener('load', () => {
  trackImpressions();
  bindClicksToAllCreatives();
  observeDynamicCreatives();
});
window.addEventListener('scroll', trackImpressions);
window.addEventListener('resize', trackImpressions);
