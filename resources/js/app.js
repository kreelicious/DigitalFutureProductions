import './bootstrap';
import '../css/app.css';

const nav = document.querySelector('[data-site-nav]');
const menu = document.querySelector('[data-nav-menu]');
const toggle = document.querySelector('[data-nav-toggle]');
const submenuPanel = document.querySelector('[data-nav-submenu]');
const submenuOpen = document.querySelector('[data-nav-submenu-open]');
const submenuClose = document.querySelector('[data-nav-submenu-close]');

const initScrollReveal = () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealTargets = Array.from(document.querySelectorAll('.section, .card, .strip, .cta-block, .hero-content > *'));

    revealTargets.forEach((element, index) => {
        if (!element.hasAttribute('data-reveal')) {
            element.setAttribute('data-reveal', '');
        }

        const delay = Math.min((index % 6) * 80, 400);
        element.style.setProperty('--reveal-delay', `${delay}ms`);
    });

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealTargets.forEach((element) => {
            element.classList.add('is-visible');
        });
        return;
    }

    const observer = new IntersectionObserver((entries, revealObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        });
    }, {
        root: null,
        threshold: 0.15,
        rootMargin: '0px 0px -8% 0px',
    });

    revealTargets.forEach((element) => observer.observe(element));
};

const updateNavState = () => {
    if (!nav) {
        return;
    }

    const isStuck = window.scrollY > 60;
    nav.dataset.stuck = isStuck ? 'true' : 'false';
    nav.classList.toggle('is-stuck', isStuck);
    nav.classList.toggle('is-at-top', !isStuck);
    nav.style.backgroundColor = isStuck ? 'rgba(25, 40, 54, 0.98)' : 'transparent';
    nav.style.boxShadow = isStuck ? '0 10px 24px rgba(0, 0, 0, 0.3)' : 'none';
};

const setSubmenuState = (open) => {
    if (!submenuPanel || !submenuOpen) {
        return;
    }

    submenuPanel.dataset.open = open ? 'true' : 'false';
    submenuOpen.setAttribute('aria-expanded', open ? 'true' : 'false');
};

const setMenuState = (open) => {
    if (!menu || !toggle) {
        return;
    }

    if (!open) {
        setSubmenuState(false);
    }

    menu.dataset.open = open ? 'true' : 'false';
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.classList.toggle('menu-open', open);
};

updateNavState();
initScrollReveal();
window.addEventListener('scroll', updateNavState, { passive: true });

if (toggle && menu) {
    toggle.addEventListener('click', () => {
        setMenuState(menu.dataset.open !== 'true');
    });

    menu.querySelectorAll('a').forEach((item) => {
        item.addEventListener('click', () => {
            setMenuState(false);
        });
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (submenuPanel?.dataset.open === 'true') {
                setSubmenuState(false);
            } else if (menu.dataset.open === 'true') {
                setMenuState(false);
            }
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024 && menu.dataset.open === 'true') {
            setMenuState(false);
        }
    });
}

if (submenuOpen) {
    submenuOpen.addEventListener('click', () => setSubmenuState(true));
}

if (submenuClose) {
    submenuClose.addEventListener('click', () => setSubmenuState(false));
}

if (submenuPanel) {
    submenuPanel.querySelectorAll('a').forEach((item) => {
        item.addEventListener('click', () => setMenuState(false));
    });
}
