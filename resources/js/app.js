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

updateNavState();
window.addEventListener('scroll', updateNavState, { passive: true });

if (toggle && menu) {
    toggle.addEventListener('click', () => {
        menu.dataset.open = menu.dataset.open === 'true' ? 'false' : 'true';
    });
}
