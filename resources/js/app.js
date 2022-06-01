import './bootstrap';

function addMenuListener() {
    document
        .getElementById("nav-button")
        .addEventListener('click', () => {
            document
                .getElementById("nav-menu")
                .classList.toggle('hidden');
        });
    console.log("Hola");
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', addMenuListener);
} else {
    addMenuListener();
}
