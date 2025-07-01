
        // Check if ad was closed in this session
        let adClosed = false;

        // Get elements
        const anchorAd = document.getElementById('kjanchor-ad');
        const closeBtn = document.getElementById('kjad-close');
        const parallaxBanner = document.getElementById('parallax-banner');

        // Close button functionality
        closeBtn.addEventListener('click', function() {
            anchorAd.classList.add('hidden');
            adClosed = true;
        });

        // Check if parallax banner is in view (now checks the spacer element)
        function checkParallaxVisibility() {
            if (adClosed) return;

            const spacer = document.querySelector('.parallax-spacer');
            const rect = spacer.getBoundingClientRect();
            const isInView = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (isInView) {
                anchorAd.classList.add('hidden');
            } else {
                anchorAd.classList.remove('hidden');
            }
        }

        // Remove parallax scroll effect as banner is now fixed
        function updateParallax() {
            // No longer needed as the banner is fixed
        }

        // Throttle function for performance
        function throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            }
        }

        // Scroll event listener with throttling
        window.addEventListener('scroll', throttle(function() {
            checkParallaxVisibility();
        }, 16)); // ~60fps

        // Initial check
        checkParallaxVisibility();

        // Add smooth scrolling for better UX
        document.documentElement.style.scrollBehavior = 'smooth';
