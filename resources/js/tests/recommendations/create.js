const MAX_WARNING_THRESHOLD = 0.9;

const form = document.querySelector('[data-test-recommendations-form]');
const submitButton = document.querySelector('[data-submit-btn]');
const buttonText = document.querySelector('[data-btn-text]');
const spinner = document.querySelector('[data-spinner]');
const aiIcon = document.querySelector('[data-ai-icon]');

if (form && submitButton && buttonText && spinner && aiIcon) {
    form.addEventListener('submit', event => {
        if (submitButton.hasAttribute('disabled')) {
            event.preventDefault();
            return;
        }

        submitButton.setAttribute('disabled', 'disabled');
        submitButton.classList.add('loading');
        spinner.classList.remove('hidden');
        aiIcon.classList.add('hidden');
        buttonText.textContent = 'Generando recomendaciones...';
        form.classList.add('animate-pulse');
    });
}

document.querySelectorAll('[data-character-count]').forEach(textarea => {
    const maxLength = Number(textarea.dataset.characterLimit ?? 500);
    const counter = document.createElement('div');
    counter.className = 'text-xs text-base-content/60 mt-1 text-right';
    textarea.parentElement?.appendChild(counter);

    const updateCounter = () => {
        const currentLength = textarea.value.length;
        counter.textContent = `${currentLength}/${maxLength}`;

        if (currentLength > maxLength * MAX_WARNING_THRESHOLD) {
            counter.classList.add('text-warning');
        } else {
            counter.classList.remove('text-warning');
        }
    };

    textarea.addEventListener('input', updateCounter);
    updateCounter();
});
