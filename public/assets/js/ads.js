// Debug logging to verify script loads
console.log('🚀 Ad tracking script loaded successfully!');

function isInViewport(el) {
  console.log('🔍 Checking viewport for element:', el);
  
  const rect = el.getBoundingClientRect();
  const windowHeight = window.innerHeight || document.documentElement.clientHeight;
  const windowWidth = window.innerWidth || document.documentElement.clientWidth;
  
  console.log('📏 Element rect:', rect);
  console.log('🖼️ Window dimensions:', {width: windowWidth, height: windowHeight});
  
  // Check if at least 50% of the element is visible
  const verticalVisible = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
  const horizontalVisible = Math.min(rect.right, windowWidth) - Math.max(rect.left, 0);
  
  const elementHeight = rect.bottom - rect.top;
  const elementWidth = rect.right - rect.left;
  
  const verticalPercentage = verticalVisible / elementHeight;
  const horizontalPercentage = horizontalVisible / elementWidth;
  
  console.log('📊 Visibility percentages:', {
    vertical: verticalPercentage,
    horizontal: horizontalPercentage
  });
  
  // Element is considered "in viewport" if at least 50% is visible both vertically and horizontally
  const isVisible = verticalPercentage >= 0.5 && horizontalPercentage >= 0.5;
  console.log('✅ Is element visible?', isVisible);
  
  return isVisible;
}

function trackImpressions() {
  console.log('🎯 trackImpressions() called');
  
  const adTags = document.querySelectorAll('.adnm-tag');
  console.log('📍 Found ad tags:', adTags.length);
  
  if (adTags.length === 0) {
    console.warn('⚠️ No .adnm-tag elements found on page');
    return;
  }
  
  adTags.forEach((ad, index) => {
    console.log(`🔍 Processing ad ${index + 1}:`, ad);
    console.log(`📊 Ad ${index + 1} already tracked?`, ad.dataset.tracked);
    
    if (ad.dataset.tracked === 'true') {
      console.log(`⏭️ Ad ${index + 1} already tracked, skipping`);
      return;
    }

    if (isInViewport(ad)) {
      ad.dataset.tracked = 'true';
      console.log('👁️ Tracking impression for ad:', ad);

      const formData = new FormData();
      const token = document.querySelector('meta[name="csrf-token"]');
      
      if (!token) {
        console.error('❌ CSRF token not found');
        return;
      }
      
      console.log('🔑 CSRF token found:', token.content);
      
      formData.append('_token', token.content);
      formData.append('action', 'impression');
      
      console.log('📤 Sending impression request to /track-impression');

      fetch('/track-impression', {
        method: 'POST',
        body: formData
      })
      .then(res => {
        console.log('📥 Response status:', res.status);
        return res.ok ? res.json() : Promise.reject(res);
      })
      .then(data => {
        console.log('✅ Impression logged successfully:', data);
      })
      .catch(err => {
        console.error('❌ Impression tracking failed:', err);
        // Reset tracking flag on error so it can retry
        ad.dataset.tracked = 'false';
      });
    } else {
      console.log(`👀 Ad ${index + 1} not in viewport yet`);
    }
  });
}

// Track clicks function
function trackClick() {
  console.log('🖱️ trackClick() called');

  const formData = new FormData();
  const token = document.querySelector('meta[name="csrf-token"]');
  
  if (!token) {
    console.error('❌ CSRF token not found');
    return;
  }
  
  console.log('🔑 CSRF token found for click:', token.content);
  
  formData.append('_token', token.content);
  formData.append('action', 'click');
  
  console.log('📤 Sending click request to /track-impression');

  fetch('/track-impression', {
    method: 'POST',
    body: formData
  })
  .then(res => {
    console.log('📥 Click response status:', res.status);
    return res.ok ? res.json() : Promise.reject(res);
  })
  .then(data => {
    console.log('✅ Click tracked successfully:', data);
  })
  .catch(err => {
    console.error('❌ Click tracking failed:', err);
  });
}

// Prevent duplicate click tracking
const trackedElements = new WeakSet();

function attachClickTracking(el) {
  console.log('🔗 Attempting to attach click tracking to:', el);
  
  if (trackedElements.has(el)) {
    console.log('⏭️ Click tracking already attached to this element');
    return;
  }
  
  trackedElements.add(el);
  console.log('✅ Click tracking attached to element:', el.className);

  // For banner ads (pre and post), use mousedown to track before redirect
  if (el.classList.contains('adnm-creative__prebanner') || el.classList.contains('adnm-creative__postbanner')) {
    console.log('🏷️ Attaching mousedown event for banner:', el.className);
    
    el.addEventListener('mousedown', function(e) {
      console.log('🖱️ Banner mousedown detected:', el.className);
      trackClick();
      // Don't prevent default - let the ad redirect work
    });
  }
  
  // For video ads and other creatives, use click event
  else {
    console.log('🎬 Attaching click event for creative:', el.className);
    
    el.addEventListener('click', function(e) {
      console.log('🖱️ Creative click detected:', el.className);
      trackClick();
      // Don't prevent default - let the ad redirect work
    });
  }
}

// Enhanced iframe click detection for video ads
function setupIframeClickTracking() {
  console.log('🎬 Setting up iframe click tracking');
  
  const iframes = document.querySelectorAll('iframe[data-adnm-channel]');
  console.log('📺 Found ad iframes:', iframes.length);
  
  // Track clicks on video ad iframes
  iframes.forEach((iframe, index) => {
    console.log(`🎬 Processing iframe ${index + 1}:`, iframe);
    
    if (trackedElements.has(iframe)) {
      console.log(`⏭️ Iframe ${index + 1} already processed`);
      return;
    }
    
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
      console.log(`✅ Overlay added to iframe ${index + 1}`);
      
      // Enable pointer events on hover
      parent.addEventListener('mouseenter', () => {
        console.log(`🖱️ Mouse entered iframe ${index + 1} area`);
        overlay.style.pointerEvents = 'auto';
      });
      
      parent.addEventListener('mouseleave', () => {
        console.log(`🖱️ Mouse left iframe ${index + 1} area`);
        overlay.style.pointerEvents = 'none';
      });
      
      // Track clicks on overlay
      overlay.addEventListener('click', function(e) {
        console.log(`🖱️ Video iframe ${index + 1} click detected`);
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
    } else {
      console.warn(`⚠️ Could not add overlay to iframe ${index + 1} - invalid parent`);
    }
  });
}

// Alternative approach: Monitor for window blur (indicates possible redirect)
let lastClickTime = 0;
let clickTimeout;

function setupWindowBlurTracking() {
  console.log('👁️ Setting up window blur tracking');
  
  // Track potential ad clicks via window blur
  document.addEventListener('mousedown', function(e) {
    const adElement = e.target.closest('.adnm-creative, .adnm-tag, iframe[data-adnm-channel]');
    if (adElement) {
      console.log('🖱️ Potential ad click detected via mousedown on:', adElement);
      lastClickTime = Date.now();
      
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
  console.log('👀 Starting mutation observer for ad creatives');
  
  const observer = new MutationObserver((mutations) => {
    console.log('🔄 DOM mutations detected:', mutations.length);
    
    // Attach click tracking to all ad creatives
    const creatives = document.querySelectorAll('.adnm-creative');
    console.log('🎨 Found ad creatives:', creatives.length);
    
    creatives.forEach((creative, index) => {
      console.log(`🎨 Processing creative ${index + 1}:`, creative.className);
      attachClickTracking(creative);
    });
    
    // Setup iframe click tracking for video ads
    setupIframeClickTracking();
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });
  
  console.log('✅ Mutation observer started');
}

function initializeTracking() {
  console.log('🚀 Initializing ad tracking...');
  
  // Check page elements
  console.log('📊 Page analysis:');
  console.log('- .adnm-tag elements:', document.querySelectorAll('.adnm-tag').length);
  console.log('- .adnm-creative elements:', document.querySelectorAll('.adnm-creative').length);
  console.log('- iframe[data-adnm-channel] elements:', document.querySelectorAll('iframe[data-adnm-channel]').length);
  console.log('- CSRF token:', document.querySelector('meta[name="csrf-token"]') ? 'Found' : 'Missing');
  
  trackImpressions();     // initial impression check
  observeAdCreatives();   // start watching for ad creatives
  setupWindowBlurTracking(); // backup click tracking method
  
  // Initial setup for existing elements
  const existingCreatives = document.querySelectorAll('.adnm-creative');
  console.log('🎨 Attaching click tracking to existing creatives:', existingCreatives.length);
  existingCreatives.forEach(attachClickTracking);
  
  setupIframeClickTracking();
  
  console.log('✅ Ad tracking initialization complete!');
}

// Initialize everything
console.log('📋 Adding event listeners...');

window.addEventListener('scroll', () => {
  console.log('📜 Scroll event detected');
  trackImpressions();
});

window.addEventListener('resize', () => {
  console.log('📏 Resize event detected');
  trackImpressions();
});

// Use DOMContentLoaded for faster initial load
if (document.readyState === 'loading') {
  console.log('⏳ DOM still loading, waiting for DOMContentLoaded...');
  document.addEventListener('DOMContentLoaded', initializeTracking);
} else {
  console.log('✅ DOM already loaded, initializing immediately');
  initializeTracking();
}

// Also run on full window load as backup
window.addEventListener('load', () => {
  console.log('🌐 Window load event detected');
  initializeTracking();
});

console.log('🎯 Ad tracking script setup complete!');