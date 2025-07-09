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
    const ads = document.querySelectorAll('.adnm-tag');
    ads.forEach(ad => {
      if (ad.dataset.tracked === 'true') return;
      if (isInViewport(ad)) {
        ad.dataset.tracked = 'true';

        const formData = new FormData();
        const token = document.querySelector('meta[name="csrf-token"]').content;
        formData.append('_token', token);
        formData.append('creative_id', ad.getAttribute('data-adnm-cc'));
        formData.append('session_id', ad.getAttribute('data-adnm-session'));
        formData.append('type', ad.getAttribute('data-adnm-type'));

        fetch('/track-impression', {
          method: 'POST',
          body: formData
        })
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => console.log('👁️ Impression logged:', data))
        .catch(err => console.error('❌ Impression tracking failed:', err));
      }
    });
  }

  function bindClickTracking() {
    const ads = document.querySelectorAll('.adnm-tag');
    ads.forEach(ad => {
      ad.addEventListener('click', function () {
        const formData = new FormData();
        const token = document.querySelector('meta[name="csrf-token"]').content;
        formData.append('_token', token);
        formData.append('action', 'click');

        fetch('/track-impression', {
          method: 'POST',
          body: formData
        })
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => console.log('🖱️ Click logged:', data))
        .catch(err => console.error('❌ Click tracking failed:', err));
      });
    });
  }

  window.addEventListener('scroll', trackImpressions);
  window.addEventListener('load', function () {
    trackImpressions();
    bindClickTracking(); // bind after DOM is ready
  });
  window.addEventListener('resize', trackImpressions);