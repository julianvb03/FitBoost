import { autoHideAlerts } from '../shared/autoHideAlerts';

document.addEventListener('DOMContentLoaded', () => {
    autoHideAlerts();

    const openButtons = document.querySelectorAll('[data-modal-open]');
    openButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-modal-open');
            if (!targetId) {
                return;
            }
            const modal = document.getElementById(targetId);
            if (modal && typeof modal.showModal === 'function') {
                modal.showModal();
            }
        });
    });

    const closeButtons = document.querySelectorAll('[data-modal-close]');
    closeButtons.forEach((button) => {
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

    const editForm = document.getElementById('editReviewForm');
    const editModal = document.getElementById('editReviewModal');
    const editCommentInput = document.getElementById('editComment');

    const editButtons = document.querySelectorAll('[data-review-edit]');
    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!editForm || !editModal) {
                return;
            }

            const url = button.getAttribute('data-review-edit-url');
            const rating = button.getAttribute('data-review-rating');
            const comment = button.getAttribute('data-review-comment') ?? '';

            if (url) {
                editForm.setAttribute('action', url);
            }

            if (rating) {
                const ratingInput = document.getElementById(`edit-rating-${rating}`);
                if (ratingInput) {
                    ratingInput.checked = true;
                }
            }

            if (editCommentInput) {
                editCommentInput.value = comment;
                editCommentInput.dispatchEvent(new Event('input'));
            }

            if (typeof editModal.showModal === 'function') {
                editModal.showModal();
            }
        });
    });

    const deleteForm = document.getElementById('deleteReviewForm');
    const deleteModal = document.getElementById('deleteReviewModal');
    const deleteButtons = document.querySelectorAll('[data-review-delete]');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!deleteForm || !deleteModal) {
                return;
            }

            const url = button.getAttribute('data-review-delete-url');
            if (url) {
                deleteForm.setAttribute('action', url);
            }

            if (typeof deleteModal.showModal === 'function') {
                deleteModal.showModal();
            }
        });
    });

    const reportForm = document.getElementById('reportReviewForm');
    const reportModal = document.getElementById('reportReviewModal');
    const reportButtons = document.querySelectorAll('[data-review-report]');

    reportButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!reportForm || !reportModal) {
                return;
            }

            const url = button.getAttribute('data-review-report-url');
            if (url) {
                reportForm.setAttribute('action', url);
            }

            if (typeof reportModal.showModal === 'function') {
                reportModal.showModal();
            }
        });
    });

    const textareas = document.querySelectorAll('textarea[maxlength]');
    textareas.forEach((textarea) => {
        const maxLength = Number(textarea.getAttribute('maxlength')) || 0;
        const label = textarea.parentElement?.querySelector('.label-text-alt');

        const updateCounter = () => {
            if (!label || !maxLength) {
                return;
            }

            const remaining = maxLength - textarea.value.length;
            label.textContent = `${remaining} caracteres restantes`;

            if (remaining < 50) {
                label.classList.add('text-warning');
            } else {
                label.classList.remove('text-warning');
            }
        };

        updateCounter();
        textarea.addEventListener('input', updateCounter);
    });

    document.addEventListener('click', (event) => {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach((dropdown) => {
            if (!dropdown.contains(event.target)) {
                const trigger = dropdown.querySelector('[tabindex="0"]');
                trigger?.blur();
            }
        });
    });
});
