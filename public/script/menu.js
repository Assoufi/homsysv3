/* ========================================
   HOMSYS MENU - CROSS-BROWSER & MOBILE
   VANILLA JAVASCRIPT - NO DEPENDENCIES
   ======================================== */

(function() {
    'use strict';

    // ====== FEATURE DETECTION ======
    const isTouchDevice = () => {
        return (
            (typeof window !== 'undefined' &&
                ('ontouchstart' in window ||
                    (window.DocumentTouch && typeof document !== 'undefined' && document instanceof window.DocumentTouch) ||
                    navigator.maxTouchPoints > 0 ||
                    navigator.msMaxTouchPoints > 0))
        );
    };

    const isFirefox = () => /firefox/i.test(navigator.userAgent);
    const isSafari = () => /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    // ====== DOM ELEMENTS ======
    let mobileToggle = null;
    let mainNav = null;
    let navOverlay = null;
    let menuItems = null;
    let submenus = null;

    // ====== STATE ======
    let isMenuOpen = false;
    let touchStartX = 0;
    let touchEndX = 0;

    // ====== INITIALIZATION ======
    document.addEventListener('DOMContentLoaded', function() {
        initializeElements();
        setupEventListeners();
        initializeAccessibility();
    });

    // Also initialize if DOM is already ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initializeElements();
            setupEventListeners();
            initializeAccessibility();
        });
    } else {
        initializeElements();
        setupEventListeners();
        initializeAccessibility();
    }

    // ====== INITIALIZE DOM ELEMENTS ======
    function initializeElements() {
        mobileToggle = document.querySelector('.mobile-menu-toggle');
        mainNav = document.querySelector('.main-menu');
        navOverlay = document.querySelector('.nav-overlay');
        menuItems = document.querySelectorAll('.menu-item');
        submenus = document.querySelectorAll('.sub-menu');

        // Fallback if elements not found
        if (!mainNav || !mobileToggle) {
            console.warn('Menu elements not found. Check your HTML structure.');
            return;
        }
    }

    // ====== EVENT LISTENERS SETUP ======
    function setupEventListeners() {
        // Mobile menu toggle
        if (mobileToggle) {
            mobileToggle.addEventListener('click', toggleMobileMenu);
            mobileToggle.addEventListener('touchstart', toggleMobileMenu, { passive: false });

            // Firefox specific: Add touch support
            if (isFirefox()) {
                mobileToggle.addEventListener('pointerdown', toggleMobileMenu);
            }
        }

        // Overlay click
        if (navOverlay) {
            navOverlay.addEventListener('click', closeMobileMenu);
            navOverlay.addEventListener('touchend', closeMobileMenu);
        }

        // Menu links
        menuItems.forEach(item => {
            const link = item.querySelector('a');
            const submenu = item.querySelector('.sub-menu');

            if (link) {
                // Close menu on regular link click (no submenu)
                if (!submenu) {
                    link.addEventListener('click', function() {
                        closeMobileMenu();
                    });

                    // Touch event
                    link.addEventListener('touchend', function(e) {
                        // Prevent double trigger
                        if (e.cancelable) {
                            e.preventDefault();
                        }
                        closeMobileMenu();
                    }, { passive: false });
                } else {
                    // Toggle submenu on mobile
                    link.addEventListener('click', function(e) {
                        if (isMobile()) {
                            e.preventDefault();
                            toggleSubmenuHandler(item, submenu, e);
                        }
                    });

                    // Touch support for submenu
                    link.addEventListener('touchend', function(e) {
                        if (isMobile()) {
                            e.preventDefault();
                            toggleSubmenuHandler(item, submenu, e);
                        }
                    }, { passive: false });
                }

                // Keyboard navigation
                link.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeMobileMenu();
                        link.blur();
                    }
                    // Enter key for links with submenus
                    if (e.key === 'Enter' && submenu && isMobile()) {
                        e.preventDefault();
                        toggleSubmenu(item, submenu);
                    }
                });
            }
        });

        // Resize handler for responsive behavior
        window.addEventListener('resize', handleWindowResize);
        window.addEventListener('orientationchange', handleWindowResize);

        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeMobileMenu();
            }
        });

        // Close menu when scrolling (optional, uncomment if desired)
        // document.addEventListener('scroll', closeMobileMenu);

        // Firefox specific: Handle click outside
        if (isFirefox()) {
            document.addEventListener('click', function(e) {
                const isMenuClick = mainNav && mainNav.contains(e.target);
                const isToggleClick = mobileToggle && mobileToggle.contains(e.target);

                if (!isMenuClick && !isToggleClick && isMenuOpen && isMobile()) {
                    closeMobileMenu();
                }
            });
        }

        // Touch swipe support
        if (isTouchDevice()) {
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, false);

            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, false);
        }
    }

    // ====== TOGGLE MOBILE MENU ======
    function toggleMobileMenu(e) {
        if (e.type.includes('touch')) {
            e.preventDefault();
        }

        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            openMobileMenu();
        } else {
            closeMobileMenu();
        }
    }

    // ====== OPEN MOBILE MENU ======
    function openMobileMenu() {
        if (!mobileToggle || !mainNav || !navOverlay) return;

        mobileToggle.classList.add('active');
        mainNav.classList.add('active');
        navOverlay.classList.add('active');
        isMenuOpen = true;

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        // Firefox specific
        if (isFirefox()) {
            mainNav.setAttribute('aria-expanded', 'true');
        }
    }

    // ====== CLOSE MOBILE MENU ======
    function closeMobileMenu() {
        if (!mobileToggle || !mainNav || !navOverlay) return;

        mobileToggle.classList.remove('active');
        mainNav.classList.remove('active');
        navOverlay.classList.remove('active');
        isMenuOpen = false;

        // Close all submenus
        menuItems.forEach(item => {
            item.classList.remove('active');
            const submenu = item.querySelector('.sub-menu');
            if (submenu) {
                submenu.style.display = '';
            }
        });

        // Restore body scroll
        document.body.style.overflow = '';

        // Firefox specific
        if (isFirefox()) {
            mainNav.setAttribute('aria-expanded', 'false');
        }
    }

    // ====== TOGGLE SUBMENU (Mobile) ======
    function toggleSubmenuHandler(item, submenu, e) {
        if (!isMobile()) return;

        e.stopPropagation();

        const isOpen = submenu.style.display === 'block';

        // Close all other submenus
        menuItems.forEach(i => {
            if (i !== item) {
                i.classList.remove('active');
                const sm = i.querySelector('.sub-menu');
                if (sm) {
                    sm.style.display = '';
                }
            }
        });

        // Toggle current submenu
        if (isOpen) {
            submenu.style.display = '';
            item.classList.remove('active');
        } else {
            submenu.style.display = 'block';
            item.classList.add('active');
        }
    }

    // ====== CHECK IF MOBILE ======
    function isMobile() {
        return window.innerWidth <= 768;
    }

    // ====== HANDLE WINDOW RESIZE ======
    let resizeTimer;
    function handleWindowResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 768) {
                // Close menu on desktop
                closeMobileMenu();

                // Reset all submenus
                menuItems.forEach(item => {
                    item.classList.remove('active');
                    const submenu = item.querySelector('.sub-menu');
                    if (submenu) {
                        submenu.style.display = '';
                    }
                });
            }
        }, 250);
    }

    // ====== HANDLE SWIPE GESTURE ======
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        // Swiped left (close menu)
        if (diff > swipeThreshold && isMenuOpen) {
            closeMobileMenu();
        }

        // Swiped right (open menu)
        if (diff < -swipeThreshold && !isMenuOpen && isMobile()) {
            openMobileMenu();
        }
    }

    // ====== ACCESSIBILITY SETUP ======
    function initializeAccessibility() {
        // Set initial ARIA attributes
        if (mobileToggle) {
            mobileToggle.setAttribute('aria-label', 'Menu');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }

        if (mainNav) {
            mainNav.setAttribute('role', 'menubar');
        }

        // Set ARIA attributes for menu items with submenus
        menuItems.forEach(item => {
            const link = item.querySelector('a');
            const submenu = item.querySelector('.sub-menu');

            if (link && submenu) {
                link.setAttribute('aria-haspopup', 'true');
                link.setAttribute('aria-expanded', 'false');
                submenu.setAttribute('role', 'menu');
            }
        });

        // Update ARIA on toggle
        if (mobileToggle) {
            const originalToggle = mobileToggle.onclick;
            mobileToggle.addEventListener('click', function() {
                const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
                mobileToggle.setAttribute('aria-expanded', !isExpanded);
            });
        }
    }

    // ====== POLYFILL FOR OLDER BROWSERS ======
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback) {
            return window.setTimeout(callback, 16);
        };
    }

    // ====== ERROR HANDLING ======
    window.addEventListener('error', function(event) {
        console.error('Menu error:', event.error);
    });

    // Export public API if needed
    window.HomsysMenu = {
        open: openMobileMenu,
        close: closeMobileMenu,
        toggle: toggleMobileMenu,
        isMobile: isMobile,
        isTouchDevice: isTouchDevice
    };

})();
