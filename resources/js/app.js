import './bootstrap';

const nav = document.querySelector('[data-site-nav]');
const menu = document.querySelector('[data-nav-menu]');
const toggle = document.querySelector('[data-nav-toggle]');

const updateNavState = () => {
    if (!nav) {
        return;
    }

    nav.dataset.stuck = window.scrollY > 60 ? 'true' : 'false';
};

const setMenuState = (open) => {
    if (!menu || !toggle) {
        return;
    }

    menu.dataset.open = open ? 'true' : 'false';
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.classList.toggle('menu-open', open);
};

updateNavState();
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
        if (event.key === 'Escape' && menu.dataset.open === 'true') {
            setMenuState(false);
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024 && menu.dataset.open === 'true') {
            setMenuState(false);
        }
    });
}
