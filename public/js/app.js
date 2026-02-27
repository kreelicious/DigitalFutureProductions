(function () {
    function initNav() {
        const nav = document.querySelector('[data-site-nav]');
        const menuButton = document.querySelector('[data-nav-toggle]');
        const mobileMenu = document.querySelector('[data-nav-menu]');

        if (nav) {
            const onScroll = () => {
                const isStuck = window.scrollY > 60;
                nav.dataset.stuck = isStuck ? 'true' : 'false';
                nav.classList.toggle('is-stuck', isStuck);
                nav.classList.toggle('is-at-top', !isStuck);
                nav.style.backgroundColor = isStuck ? 'rgba(25, 40, 54, 0.98)' : 'transparent';
                nav.style.boxShadow = isStuck ? '0 10px 24px rgba(0, 0, 0, 0.3)' : 'none';
                nav.style.backdropFilter = isStuck ? 'saturate(130%) blur(6px)' : 'none';
            };

            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
        }

        if (!menuButton || !mobileMenu) return;

        const setMenuState = (isOpen) => {
            mobileMenu.dataset.open = isOpen ? 'true' : 'false';
            menuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            document.body.classList.toggle('menu-open', isOpen);
        };

        menuButton.addEventListener('click', (event) => {
            event.preventDefault();
            setMenuState(mobileMenu.dataset.open !== 'true');
        });

        mobileMenu.querySelectorAll('a').forEach((item) => {
            item.addEventListener('click', () => {
                setMenuState(false);
            });
        });

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && mobileMenu.dataset.open === 'true') {
                setMenuState(false);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNav, { once: true });
    } else {
        initNav();
    }
})();
