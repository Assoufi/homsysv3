/**
 * Menu Accessibility & Keyboard Navigation
 * Implements WAI-ARIA patterns and keyboard support for accessible navigation
 * 
 * Features:
 * - Tab/Shift+Tab navigation through menu items
 * - Arrow key navigation (Left/Right for main menu, Up/Down for submenus)
 * - Enter/Space to activate links or toggle submenus
 * - Escape to close submenus
 * - Proper ARIA state management
 */

(function () {
    'use strict';

    // Configuration
    const config = {
        menuSelector: '#nav',
        navSelector: '.navbar-nav',
        submenuSelector: '.sub-menu',
        linkSelector: 'a',
        activeClass: 'active',
        expandedAttr: 'aria-expanded',
        hasPopupAttr: 'aria-haspopup',
        timeoutDelay: 500
    };

    // State management
    const state = {
        currentMenuLevel: 0,
        currentItemIndex: -1,
        timeoutId: null
    };

    // Initialize
    function init() {
        const navElement = document.querySelector(config.menuSelector);
        if (!navElement) return;

        // Attach event listeners
        attachMenuEventListeners();
        attachKeyboardEventListeners();
        setupAriaStates();
    }

    /**
     * Attach event listeners to menu items
     */
    function attachMenuEventListeners() {
        const mainMenu = document.querySelector(config.menuSelector + ' ' + config.navSelector);
        if (!mainMenu) return;

        const menuItems = mainMenu.querySelectorAll(':scope > li');

        menuItems.forEach((item, index) => {
            const link = item.querySelector(config.linkSelector);
            const submenu = item.querySelector(config.submenuSelector);

            if (!link) return;

            // Mouse enter - show submenu
            item.addEventListener('mouseenter', function () {
                clearTimeout(state.timeoutId);
                if (submenu) {
                    showSubmenu(item, link);
                }
            });

            // Mouse leave - hide submenu with delay
            item.addEventListener('mouseleave', function () {
                clearTimeout(state.timeoutId);
                state.timeoutId = setTimeout(() => {
                    if (submenu) {
                        hideSubmenu(item, link);
                    }
                }, config.timeoutDelay);
            });

            // Click on menu item with submenu
            if (submenu) {
                link.addEventListener('click', function (e) {
                    const isExpanded = link.getAttribute(config.expandedAttr) === 'true';
                    if (isExpanded) {
                        e.preventDefault();
                    }
                });
            }
        });

        // Handle submenu items
        const submenuItems = mainMenu.querySelectorAll(config.submenuSelector + ' > li > ' + config.linkSelector);
        submenuItems.forEach(link => {
            link.addEventListener('focus', function () {
                const submenu = this.closest(config.submenuSelector);
                if (submenu) {
                    const parentItem = submenu.closest('li');
                    if (parentItem) {
                        const parentLink = parentItem.querySelector(':scope > ' + config.linkSelector);
                        if (parentLink) {
                            showSubmenu(parentItem, parentLink);
                        }
                    }
                }
            });
        });
    }

    /**
     * Attach keyboard event listeners
     */
    function attachKeyboardEventListeners() {
        const navElement = document.querySelector(config.menuSelector);
        if (!navElement) return;

        document.addEventListener('keydown', function (e) {
            const activeElement = document.activeElement;
            const menuContainer = activeElement.closest(config.menuSelector);

            if (!menuContainer) return;

            const navBar = menuContainer.querySelector(config.navSelector);
            if (!navBar) return;

            const mainMenuItems = navBar.querySelectorAll(':scope > li');
            const currentItem = activeElement.closest(config.navSelector + ' > li');

            if (!currentItem) return;

            const isInSubmenu = activeElement.closest(config.submenuSelector);

            switch (e.key) {
                case 'ArrowRight':
                    e.preventDefault();
                    handleArrowRight(currentItem, mainMenuItems, isInSubmenu);
                    break;

                case 'ArrowLeft':
                    e.preventDefault();
                    handleArrowLeft(currentItem, mainMenuItems, isInSubmenu);
                    break;

                case 'ArrowDown':
                    e.preventDefault();
                    handleArrowDown(currentItem);
                    break;

                case 'ArrowUp':
                    e.preventDefault();
                    handleArrowUp(currentItem);
                    break;

                case 'Enter':
                case ' ':
                    handleEnterOrSpace(e, activeElement);
                    break;

                case 'Escape':
                    e.preventDefault();
                    handleEscape(currentItem);
                    break;

                case 'Home':
                    e.preventDefault();
                    focusFirstMenuItem(mainMenuItems);
                    break;

                case 'End':
                    e.preventDefault();
                    focusLastMenuItem(mainMenuItems);
                    break;
            }
        });
    }

    /**
     * Handle Right Arrow key
     */
    function handleArrowRight(currentItem, allMenuItems, isInSubmenu) {
        if (isInSubmenu) {
            // Move to parent menu and next item
            closeSubmenus(currentItem);
        }

        const nextItem = currentItem.nextElementSibling;
        if (nextItem && nextItem.tagName === 'LI') {
            const nextLink = nextItem.querySelector(config.linkSelector);
            if (nextLink) nextLink.focus();
        }
    }

    /**
     * Handle Left Arrow key
     */
    function handleArrowLeft(currentItem, allMenuItems, isInSubmenu) {
        if (isInSubmenu) {
            // Move to parent menu and previous item
            closeSubmenus(currentItem);
        }

        const prevItem = currentItem.previousElementSibling;
        if (prevItem && prevItem.tagName === 'LI') {
            const prevLink = prevItem.querySelector(config.linkSelector);
            if (prevLink) prevLink.focus();
        }
    }

    /**
     * Handle Down Arrow key
     */
    function handleArrowDown(currentItem) {
        const submenu = currentItem.querySelector(config.submenuSelector);

        if (submenu && submenu.style.display !== 'none') {
            // Move to first submenu item
            const firstSubmenuItem = submenu.querySelector(config.linkSelector);
            if (firstSubmenuItem) {
                firstSubmenuItem.focus();
            }
        } else if (submenu) {
            // Open submenu
            const link = currentItem.querySelector(':scope > ' + config.linkSelector);
            if (link) {
                showSubmenu(currentItem, link);
                const firstSubmenuItem = submenu.querySelector(config.linkSelector);
                if (firstSubmenuItem) {
                    firstSubmenuItem.focus();
                }
            }
        }
    }

    /**
     * Handle Up Arrow key
     */
    function handleArrowUp(currentItem) {
        const submenu = currentItem.closest(config.submenuSelector);

        if (submenu) {
            // We're in a submenu, move to previous item or close
            const currentSubmenuItem = currentItem.closest(config.submenuSelector + ' > li');
            const prevSubmenuItem = currentSubmenuItem ? currentSubmenuItem.previousElementSibling : null;

            if (prevSubmenuItem) {
                const prevLink = prevSubmenuItem.querySelector(config.linkSelector);
                if (prevLink) prevLink.focus();
            } else {
                // Close submenu and focus parent
                const parentItem = submenu.closest('li');
                if (parentItem) {
                    const parentLink = parentItem.querySelector(':scope > ' + config.linkSelector);
                    if (parentLink) {
                        closeSubmenus(parentItem);
                        parentLink.focus();
                    }
                }
            }
        }
    }

    /**
     * Handle Enter or Space key
     */
    function handleEnterOrSpace(e, activeElement) {
        if (activeElement.tagName === 'A') {
            const item = activeElement.closest('li');
            const submenu = item ? item.querySelector(config.submenuSelector) : null;

            if (submenu) {
                e.preventDefault();
                const isExpanded = activeElement.getAttribute(config.expandedAttr) === 'true';

                if (isExpanded) {
                    hideSubmenu(item, activeElement);
                } else {
                    showSubmenu(item, activeElement);
                }
            }
        }
    }

    /**
     * Handle Escape key
     */
    function handleEscape(currentItem) {
        const submenu = currentItem.closest(config.submenuSelector);

        if (submenu) {
            // Close submenu and focus parent
            const parentItem = submenu.closest('li');
            if (parentItem) {
                closeSubmenus(parentItem);
                const parentLink = parentItem.querySelector(':scope > ' + config.linkSelector);
                if (parentLink) parentLink.focus();
            }
        } else {
            // Close current item's submenu if open
            closeSubmenus(currentItem);
        }
    }

    /**
     * Focus first menu item
     */
    function focusFirstMenuItem(menuItems) {
        if (menuItems.length > 0) {
            const firstLink = menuItems[0].querySelector(config.linkSelector);
            if (firstLink) firstLink.focus();
        }
    }

    /**
     * Focus last menu item
     */
    function focusLastMenuItem(menuItems) {
        if (menuItems.length > 0) {
            const lastLink = menuItems[menuItems.length - 1].querySelector(config.linkSelector);
            if (lastLink) lastLink.focus();
        }
    }

    /**
     * Show submenu with ARIA state management
     */
    function showSubmenu(item, link) {
        const submenu = item.querySelector(config.submenuSelector);

        if (submenu && link) {
            // Update ARIA state
            link.setAttribute(config.expandedAttr, 'true');

            // Show submenu
            submenu.style.display = 'block';

            // Add focus trap for better keyboard navigation
            setupSubmenuFocusTrap(submenu);
        }
    }

    /**
     * Hide submenu with ARIA state management
     */
    function hideSubmenu(item, link) {
        const submenu = item.querySelector(config.submenuSelector);

        if (submenu && link) {
            // Update ARIA state
            link.setAttribute(config.expandedAttr, 'false');

            // Hide submenu
            submenu.style.display = 'none';
        }
    }

    /**
     * Close all submenus for a given item
     */
    function closeSubmenus(item) {
        const submenu = item.querySelector(config.submenuSelector);
        const link = item.querySelector(':scope > ' + config.linkSelector);

        if (submenu && link) {
            hideSubmenu(item, link);
        }
    }

    /**
     * Setup focus trap for submenu navigation
     */
    function setupSubmenuFocusTrap(submenu) {
        const links = submenu.querySelectorAll(config.linkSelector);

        if (links.length > 0) {
            const firstLink = links[0];
            const lastLink = links[links.length - 1];

            // Handle Tab at end of submenu
            lastLink.addEventListener('keydown', function (e) {
                if (e.key === 'Tab' && !e.shiftKey) {
                    e.preventDefault();
                    firstLink.focus();
                }
            });

            // Handle Shift+Tab at beginning of submenu
            firstLink.addEventListener('keydown', function (e) {
                if (e.key === 'Tab' && e.shiftKey) {
                    e.preventDefault();
                    lastLink.focus();
                }
            });
        }
    }

    /**
     * Setup ARIA states on page load
     */
    function setupAriaStates() {
        const navElement = document.querySelector(config.menuSelector);
        if (!navElement) return;

        const menuItems = navElement.querySelectorAll(config.navSelector + ' > li > ' + config.linkSelector);

        menuItems.forEach(link => {
            const item = link.closest('li');
            const submenu = item.querySelector(config.submenuSelector);

            if (submenu) {
                link.setAttribute(config.hasPopupAttr, 'true');
                link.setAttribute(config.expandedAttr, 'false');
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
