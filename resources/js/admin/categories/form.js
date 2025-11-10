import { autoHideAlerts } from '../shared/autoHideAlerts';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-category-form]');
    const submitButton = document.getElementById('submitBtn');

    if (!form) {
        autoHideAlerts();
        return;
    }

    const trackedFields = form.querySelectorAll('[data-max-length]');

    trackedFields.forEach((field) => {
        const maxLength = Number(field.getAttribute('data-max-length')) || 0;
        const counterId = field.getAttribute('data-counter-id');
        const errorClass = field.getAttribute('data-error-class') || 'input-error';
        const counterElement = counterId ? document.getElementById(counterId) : null;

        const updateCounter = () => {
            if (!counterElement || !maxLength) {
                return;
            }

            const currentLength = field.value.length;
            counterElement.textContent = `${currentLength}/${maxLength}`;

            if (currentLength > maxLength) {
                counterElement.classList.add('text-error');
                field.classList.add(errorClass);
            } else {
                counterElement.classList.remove('text-error');
                field.classList.remove(errorClass);
            }
        };

        updateCounter();

        field.addEventListener('input', updateCounter);
    });

    if (form && submitButton) {
        form.addEventListener('submit', () => {
            const loadingText = submitButton.getAttribute('data-loading-text') || 'Guardando...';
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <span class="loading loading-spinner loading-sm mr-2"></span>
                ${loadingText}
            `;
        });
    }

    const resetButtons = document.querySelectorAll('[data-category-reset]');
    resetButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const mode = button.getAttribute('data-category-reset');
            const focusSelector = button.getAttribute('data-reset-focus');
            const nameInput = form.querySelector('#name');
            const descTextarea = form.querySelector('#description');

            if (mode === 'clear') {
                form.reset();
                trackedFields.forEach((field) => {
                    field.value = '';
                });
            }

            if (mode === 'restore') {
                const originalName = button.getAttribute('data-original-name') ?? '';
                const originalDescription = button.getAttribute('data-original-description') ?? '';

                if (nameInput) {
                    nameInput.value = originalName;
                }

                if (descTextarea) {
                    descTextarea.value = originalDescription;
                }
            }

            trackedFields.forEach((field) => {
                field.dispatchEvent(new Event('input'));
            });

            if (focusSelector) {
                const focusTarget = document.querySelector(focusSelector);
                focusTarget?.focus();
            }
        });
    });

    autoHideAlerts();
});
