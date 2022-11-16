import PerfectScrollbar from 'perfect-scrollbar/dist/perfect-scrollbar.esm';

window.PerfectScrollbar = PerfectScrollbar;


document.addEventListener('DOMContentLoaded', () => {
    const containers = document.querySelectorAll('[data-ps]');
    containers.forEach((el) => {
        const options = el.dataset.ps || {}
        const ps = new PerfectScrollbar(el, options);
    })
});
