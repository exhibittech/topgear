function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  function trackImpression() {
    const ad = document.getElementById('adnmCreative');
    if (!ad || ad.dataset.tracked) return;

    if (isInViewport(ad)) {
      ad.dataset.tracked = 'true';

      // Send POST using standard form-encoded request
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
      .then(data => console.log('Impression logged:', data))
      .catch(err => console.error('Tracking failed:', err));
    }
  }

  window.addEventListener('scroll', trackImpression);
  window.addEventListener('load', trackImpression);
  window.addEventListener('resize', trackImpression);