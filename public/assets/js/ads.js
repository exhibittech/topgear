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

  function bindClickTracking() {
    document.querySelectorAll('.adnm-creative').forEach(el => {
      el.addEventListener('click', function () {
        console.log('🖱️ Click detected on .adnm-creative');

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
    });
  }

  window.addEventListener('scroll', trackImpressions);
  window.addEventListener('resize', trackImpressions);
  window.addEventListener('load', function () {
    trackImpressions();
    bindClickTracking(); // attach click handlers
  });