document.addEventListener('DOMContentLoaded', function () {
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(function () {
            successAlert.style.transition = 'opacity 0.5s ease-out';
            successAlert.style.opacity = '0';

            setTimeout(function () {
                successAlert.remove();
            }, 500);
        }, 5000);
    }

    const resendForm = document.querySelector('form[action*="verification.resend"]');
    const resendButton = resendForm?.querySelector('button[type="submit"]');

    if (resendForm && resendButton) {
        resendForm.addEventListener('submit', function () {
            resendButton.disabled = true;
            resendButton.innerHTML = `
                <span class="loading loading-spinner loading-sm mr-2"></span>
                {{ trans('auth.sending') ?? 'Sending...' }}
            `;

            setTimeout(function () {
                resendButton.disabled = false;
                resendButton.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    {{ trans('auth.resend_verification') }}
                `;
            }, 3000);
        });
    }
});
