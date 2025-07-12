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

// Creative containers we want to track clicks on
const creativeSelectors = [
  '.adnm-creative__prebanner',
  '.adnm-html-interscroll-tag .adnm-creative', // for video
  '.adnm-creative__postbanner'
];

const trackedClickContainers = new WeakSet();

function attachClickTracking(container) {
  if (!container || trackedClickContainers.has(container)) return;

  trackedClickContainers.add(container);

  container.addEventListener('click', () => {
    console.log('🖱️ Real click tracked on:', container);

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

function watchAndBindClickTargets() {
  // Try to bind immediately
  creativeSelectors.forEach(selector => {
    document.querySelectorAll(selector).forEach(attachClickTracking);
  });

  // Watch for dynamically loaded elements
  const observer = new MutationObserver(() => {
    creativeSelectors.forEach(selector => {
      document.querySelectorAll(selector).forEach(attachClickTracking);
    });
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });
}

// Init everything
window.addEventListener('load', function () {
  trackImpressions();
  watchAndBindClickTargets();
});
window.addEventListener('scroll', trackImpressions);
window.addEventListener('resize', trackImpressions);
