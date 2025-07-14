function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    const windowWidth = window.innerWidth || document.documentElement.clientWidth;
    
    // Check if at least 50% of the element is visible
    const verticalVisible = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
    const horizontalVisible = Math.min(rect.right, windowWidth) - Math.max(rect.left, 0);
    
    const elementHeight = rect.bottom - rect.top;
    const elementWidth = rect.right - rect.left;
    
    const verticalPercentage = verticalVisible / elementHeight;
    const horizontalPercentage = horizontalVisible / elementWidth;
    
    // Element is considered "in viewport" if at least 50% is visible both vertically and horizontally
    return verticalPercentage >= 0.5 && horizontalPercentage >= 0.5;
  }

  function trackImpressions() {
    document.querySelectorAll('.adnm-tag').forEach(ad => {
      if (ad.dataset.tracked === 'true') return;

      if (isInViewport(ad)) {
        ad.dataset.tracked = 'true';
        console.log('👁️ Tracking impression for:', ad);

        const formData = new FormData();
        const token = document.querySelector('meta[name="csrf-token"]');
        
        if (!token) {
          console.error('❌ CSRF token not found');
          return;
        }
        
        formData.append('_token', token.content);
        formData.append('action', 'impression');

        fetch('/track-impression', {
          method: 'POST',
          body: formData
        })
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => console.log('✅ Impression logged:', data))
        .catch(err => {
          console.error('❌ Impression tracking failed:', err);
          // Reset tracking flag on error so it can retry
          ad.dataset.tracked = 'false';
        });
      }
    });
  }

  // Track clicks function
  function trackClick() {
    console.log('🖱️ Click detected on ad creative');

    const formData = new FormData();
    const token = document.querySelector('meta[name="csrf-token"]');
    
    if (!token) {
      console.error('❌ CSRF token not found');
      return;
    }
    
    formData.append('_token', token.content);
    formData.append('action', 'click');

    fetch('/track-impression', {
      method: 'POST',
      body: formData
    })
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => console.log('✅ Click tracked:', data))
    .catch(err => console.error('❌ Click tracking failed:', err));
  }

  // Prevent duplicate click tracking
  const trackedElements = new WeakSet();

  function attachClickTracking(el) {
    if (trackedElements.has(el)) return;
    trackedElements.add(el);

    // For banner ads (pre and post), use mousedown to track before redirect
    if (el.classList.contains('adnm-creative__prebanner') || el.classList.contains('adnm-creative__postbanner')) {
      el.addEventListener('mousedown', function(e) {
        console.log('🖱️ Banner click detected:', el.className);
        trackClick();
        // Don't prevent default - let the ad redirect work
      });
    }
    
    // For video ads and other creatives, use click event
    else {
      el.addEventListener('click', function(e) {
        console.log('🖱️ Creative click detected:', el.className);
        trackClick();
        // Don't prevent default - let the ad redirect work
      });
    }
  }

  // Enhanced iframe click detection for video ads
  function setupIframeClickTracking() {
    // Track clicks on video ad iframes
    document.querySelectorAll('iframe[data-adnm-channel]').forEach(iframe => {
      if (trackedElements.has(iframe)) return;
      trackedElements.add(iframe);

      // Create overlay for iframe click detection
      const overlay = document.createElement('div');
      overlay.style.cssText = `
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        background: transparent;
      `;
      
      const parent = iframe.parentElement;
      if (parent && parent.style.position !== 'static') {
        parent.appendChild(overlay);
        
        // Enable pointer events on hover
        parent.addEventListener('mouseenter', () => {
          overlay.style.pointerEvents = 'auto';
        });
        
        parent.addEventListener('mouseleave', () => {
          overlay.style.pointerEvents = 'none';
        });
        
        // Track clicks on overlay
        overlay.addEventListener('click', function(e) {
          console.log('🖱️ Video iframe click detected');
          trackClick();
          
          // Re-trigger click on iframe after short delay
          setTimeout(() => {
            overlay.style.pointerEvents = 'none';
            const clickEvent = new MouseEvent('click', {
              view: window,
              bubbles: true,
              cancelable: true,
              clientX: e.clientX,
              clientY: e.clientY
            });
            iframe.dispatchEvent(clickEvent);
          }, 50);
        });
      }
    });
  }

  // Alternative approach: Monitor for window blur (indicates possible redirect)
  let lastClickTime = 0;
  let clickTimeout;

  function setupWindowBlurTracking() {
    // Track potential ad clicks via window blur
    document.addEventListener('mousedown', function(e) {
      const adElement = e.target.closest('.adnm-creative, .adnm-tag, iframe[data-adnm-channel]');
      if (adElement) {
        lastClickTime = Date.now();
        console.log('🖱️ Potential ad click detected via mousedown');
        
        // Clear any existing timeout
        if (clickTimeout) {
          clearTimeout(clickTimeout);
        }
        
        // Set timeout to track click if window doesn't blur
        clickTimeout = setTimeout(() => {
          console.log('🖱️ Click tracked via timeout method');
          trackClick();
        }, 100);
      }
    });

    // If window blurs soon after click, it's likely a redirect
    window.addEventListener('blur', function() {
      if (Date.now() - lastClickTime < 500) {
        console.log('🖱️ Click tracked via window blur (redirect detected)');
        trackClick();
        
        // Clear timeout since we already tracked
        if (clickTimeout) {
          clearTimeout(clickTimeout);
          clickTimeout = null;
        }
      }
    });
  }

  function observeAdCreatives() {
    const observer = new MutationObserver(() => {
      // Attach click tracking to all ad creatives
      document.querySelectorAll('.adnm-creative').forEach(attachClickTracking);
      
      // Setup iframe click tracking for video ads
      setupIframeClickTracking();
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true
    });
  }

  // Initialize everything
  window.addEventListener('scroll', trackImpressions);
  window.addEventListener('resize', trackImpressions);
  
  // Use DOMContentLoaded for faster initial load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeTracking);
  } else {
    initializeTracking();
  }
  
  // Also run on full window load as backup
  window.addEventListener('load', initializeTracking);
  
  function initializeTracking() {
    trackImpressions();     // initial impression check
    observeAdCreatives();   // start watching for ad creatives
    setupWindowBlurTracking(); // backup click tracking method
    
    // Initial setup for existing elements
    document.querySelectorAll('.adnm-creative').forEach(attachClickTracking);
    setupIframeClickTracking();
  }