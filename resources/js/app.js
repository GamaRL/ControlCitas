import './bootstrap';

function addMenuListener() {
    document.getElementById("nav-button")
        .addEventListener('click', () => {
            document.getElementById("nav-menu")
                .classList.toggle('hidden');
            document.getElementById("nav-close")
                .classList.toggle("hidden");
            document.getElementById("nav-hamburger")
                .classList.toggle("hidden");
        });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', addMenuListener);
} else {
    addMenuListener();
}
