import { autoHideAlerts } from '../shared/autoHideAlerts';

document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('delete_modal');
    const deleteForm = document.getElementById('delete-form');
    const categoryNameTarget = document.getElementById('category-name');
    const confirmDeleteButton = document.querySelector('[data-category-confirm-delete]');
    const deleteButtons = document.querySelectorAll('[data-category-delete]');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!deleteModal || !deleteForm || !categoryNameTarget) {
                return;
            }

            const deleteUrl = button.getAttribute('data-category-url');
            const categoryName = button.getAttribute('data-category-name') ?? '';

            if (categoryNameTarget) {
                categoryNameTarget.textContent = categoryName;
            }

            if (deleteUrl) {
                deleteForm.setAttribute('action', deleteUrl);
            }

            if (typeof deleteModal.showModal === 'function') {
                deleteModal.showModal();
            }
        });
    });

    if (confirmDeleteButton && deleteForm) {
        confirmDeleteButton.addEventListener('click', () => {
            deleteForm.submit();
        });
    }

    const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
    modalCloseButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-modal-close');
            if (!targetId) {
                return;
            }
            const modal = document.getElementById(targetId);
            if (modal && typeof modal.close === 'function') {
                modal.close();
            }
        });
    });

    autoHideAlerts();
});
