const bootstrap = window.bootstrap || require('bootstrap');

function createElementFromHTML(htmlString) {
    const div = document.createElement('div');
    div.innerHTML = htmlString.trim();
    return div.firstChild;
}

function getToastTemplate(message, type = 'info') {
    return `
        <div class="toast hide align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              ${message}
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
        `;
}

const TOAST_DEFAULTS = {
    message: '',
    type: 'info',
    delay: 10000,
    container: '.toast-container'
}

class ToastNotification {
    static show(options) {
        if (typeof options === 'string') {
            options = Object.assign({}, TOAST_DEFAULTS, {message: options});
        } else if (typeof options === 'object') {
            options = Object.assign({}, TOAST_DEFAULTS, options);
        }

        const template = getToastTemplate(options.message, options.type);

        const toastElement = createElementFromHTML(template);
        if (options.delay !== false && options.delay > 0) {
            toastElement.dataset.bsDelay = options.delay;
        }

        const containerElement = document.querySelector(options.container);
        if (containerElement) {
            containerElement.appendChild(toastElement);
        }

        const toast = new bootstrap.Toast(toastElement);

        toast.show();

        toastElement.addEventListener('hidden.bs.toast', (evt) => {
            toastElement.remove();
        });
    }

    static success(message, delay = 10000) {
        this.show({message: message, delay: delay, type: 'success'});
    }

    static error(message, delay = 10000) {
        this.show({message: message, delay: delay, type: 'danger'});
    }

    static warning(message, delay = 10000) {
        this.show({message: message, delay: delay, type: 'warning'});
    }

    static info(message, delay = 10000) {
        this.show({message: message, delay: delay, type: 'info'});
    }
}

document.addEventListener('DOMContentLoaded', evt => {
    if (window.toastsData) {
        window.toastsData.forEach(it => {
            ToastNotification.show(it);
        })
    }
})

window.toast = ToastNotification;

export default ToastNotification;

export const toast = ToastNotification;

window.addEventListener('notify', (event) => {
    const type = event.detail.type
    const message = event.detail.message

    if(typeof toast[type] === 'function') {
        toast[type](message)
    } else {
        toast.info(message)
    }
})
