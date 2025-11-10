import { autoHideAlerts } from '../shared/autoHideAlerts';

const AUTO_SAVE_KEY = 'profile_draft';
const AUTO_SAVE_DELAY = 3000;
const STRENGTH_TEXTS = ['Muy débil', 'Débil', 'Regular', 'Fuerte', 'Muy fuerte'];
const STRENGTH_COLORS = ['bg-error', 'bg-warning', 'bg-info', 'bg-success', 'bg-success'];

function init() {
    autoHideAlerts();

    const form = document.querySelector('[data-profile-form]');
    if (!form) {
        return;
    }

    const passwordInput = form.querySelector('[data-password-input]');
    const confirmPasswordInput = form.querySelector('#confirm_password');
    const submitButton = form.querySelector('[data-submit-button]');
    const strengthBars = Array.from(document.querySelectorAll('[data-strength-bar]'));
    const strengthText = document.querySelector('[data-strength-text]');

    let autoSaveTimeoutId = 0;
    let loadingResetTimeoutId = 0;
    let isSubmitting = false;

    const successAlert = document.querySelector('[data-profile-success]');
    if (successAlert) {
        localStorage.removeItem(AUTO_SAVE_KEY);
    }

    setupPasswordToggles(form);
    setupPreviews(form);
    setupCardScrolling();
    setupDraftHandling(form);

    if (passwordInput) {
        const updateStrength = () => renderPasswordStrength(passwordInput.value, strengthBars, strengthText);
        passwordInput.addEventListener('input', updateStrength);
        updateStrength();
    }

    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('input', () => renderPasswordStrength(passwordInput.value, strengthBars, strengthText));
    }

    form.querySelectorAll('input, textarea').forEach((input) => {
        input.addEventListener('input', () => {
            window.clearTimeout(autoSaveTimeoutId);
            autoSaveTimeoutId = window.setTimeout(() => {
                saveDraft(form);
            }, AUTO_SAVE_DELAY);
        });
    });

    form.addEventListener('submit', (event) => {
        window.clearTimeout(autoSaveTimeoutId);

        const passwordValue = passwordInput?.value ?? '';
        const confirmValue = confirmPasswordInput?.value ?? '';

        if (passwordValue && passwordValue !== confirmValue) {
            event.preventDefault();
            showFormError(form, 'Las contraseñas no coinciden. Por favor verifica e intenta nuevamente.');
            return;
        }

        if (passwordValue && passwordValue.length < 6) {
            event.preventDefault();
            showFormError(form, 'La contraseña debe tener al menos 6 caracteres.');
            return;
        }

        isSubmitting = true;
        localStorage.removeItem(AUTO_SAVE_KEY);
        window.clearTimeout(loadingResetTimeoutId);
        loadingResetTimeoutId = showLoadingState(submitButton, () => {
            isSubmitting = false;
        });
    });

    window.addEventListener('beforeunload', () => {
        if (isSubmitting) {
            localStorage.removeItem(AUTO_SAVE_KEY);
        }
    });
}

function setupPasswordToggles(scope) {
    scope.querySelectorAll('[data-password-toggle]').forEach((button) => {
        const targetId = button.dataset.target;
        if (!targetId) {
            return;
        }

        const input = document.getElementById(targetId);
        if (!input) {
            return;
        }

        const openIcon = button.querySelector('[data-eye-open]');
        const closedIcon = button.querySelector('[data-eye-closed]');

        button.addEventListener('click', () => {
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');

            if (openIcon && closedIcon) {
                if (isPassword) {
                    openIcon.classList.add('hidden');
                    closedIcon.classList.remove('hidden');
                } else {
                    closedIcon.classList.add('hidden');
                    openIcon.classList.remove('hidden');
                }
            }
        });
    });
}

function setupPreviews(form) {
    const avatar = document.querySelector('[data-preview-avatar]');
    const avatarDefault = avatar?.dataset.previewDefault ?? '';

    form.querySelectorAll('[data-preview-source]').forEach((input) => {
        const targetKey = input.dataset.previewSource;
        if (!targetKey) {
            return;
        }

        const target = document.querySelector(`[data-preview-target="${targetKey}"]`);
        if (!target) {
            return;
        }

        const targetDefault = target.dataset.previewDefault ?? '';

        const updatePreview = () => {
            const textValue = input.value.trim();
            const displayValue = textValue || targetDefault;
            target.textContent = displayValue;

            if (targetKey === 'name' && avatar) {
                const letter = displayValue.charAt(0).toUpperCase() || avatarDefault;
                avatar.textContent = letter;
            }
        };

        input.addEventListener('input', updatePreview);
        updatePreview();
    });
}

function setupCardScrolling() {
    document.querySelectorAll('[data-scroll-card]').forEach((card) => {
        card.addEventListener('click', () => {
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
}

function setupDraftHandling(form) {
    loadDraft(form);

    // Ensure previews reflect loaded draft values.
    form.querySelectorAll('[data-preview-source]').forEach((input) => {
        input.dispatchEvent(new Event('input', { bubbles: true }));
    });
}

function renderPasswordStrength(password, bars, textElement) {
    if (!textElement || bars.length === 0) {
        return;
    }

    let strength = 0;
    if (password.length >= 8) strength += 1;
    if (/[a-z]/.test(password)) strength += 1;
    if (/[A-Z]/.test(password)) strength += 1;
    if (/[0-9]/.test(password)) strength += 1;
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;

    strength = Math.min(strength, bars.length);

    bars.forEach((bar) => {
        bar.className = 'h-3 flex-1 bg-base-300 rounded-full';
    });

    for (let index = 0; index < strength; index += 1) {
        const bar = bars[index];
        if (bar) {
            bar.className = `h-3 flex-1 rounded-full ${STRENGTH_COLORS[Math.max(strength - 1, 0)]}`;
        }
    }

    if (!password.length) {
        textElement.textContent = 'Ingresa una contraseña';
        textElement.className = 'text-sm mt-2 font-medium';
        return;
    }

    const strengthText = STRENGTH_TEXTS[strength - 1] || STRENGTH_TEXTS[0];
    textElement.textContent = strengthText;

    let modifier = 'text-error';
    if (strength >= 3) {
        modifier = 'text-success';
    } else if (strength === 2) {
        modifier = 'text-warning';
    }

    textElement.className = `text-sm mt-2 font-medium ${modifier}`;
}

function showFormError(form, message) {
    const existingError = form.querySelector('[data-inline-error]');
    if (existingError) {
        existingError.remove();
    }

    const errorAlert = document.createElement('div');
    errorAlert.className = 'alert alert-error mb-6 shadow-lg';
    errorAlert.dataset.inlineError = 'true';
    errorAlert.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>${message}</span>
    `;

    form.insertBefore(errorAlert, form.firstChild);
    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'start' });

    window.setTimeout(() => {
        errorAlert.remove();
    }, 5000);
}

function showLoadingState(button, onReset) {
    if (!button) {
        return 0;
    }

    const spinner = button.querySelector('[data-submit-spinner]');
    const icon = button.querySelector('[data-submit-icon]');
    const label = button.querySelector('[data-submit-label]');
    const originalText = label?.textContent ?? '';
    const loadingText = button.dataset.loadingText ?? 'Guardando...';

    button.disabled = true;
    spinner?.classList.remove('hidden');
    icon?.classList.add('hidden');
    if (label) {
        label.textContent = loadingText;
    }

    const timeoutId = window.setTimeout(() => {
        spinner?.classList.add('hidden');
        icon?.classList.remove('hidden');
        if (label) {
            label.textContent = originalText;
        }
        button.disabled = false;
        onReset?.();
    }, 30000);

    return timeoutId;
}

function saveDraft(form) {
    const formData = new FormData(form);
    const draft = {};

    formData.forEach((value, key) => {
        if (key.includes('password') || key === '_token' || key === '_method') {
            return;
        }
        draft[key] = value;
    });

    localStorage.setItem(AUTO_SAVE_KEY, JSON.stringify(draft));
    showSaveIndicator();
}

function loadDraft(form) {
    const rawDraft = localStorage.getItem(AUTO_SAVE_KEY);
    if (!rawDraft) {
        return;
    }

    try {
        const draft = JSON.parse(rawDraft);

        Object.entries(draft).forEach(([key, value]) => {
            const field = form.elements.namedItem(key);
            if (!field) {
                return;
            }

            const isRadioNodeList = typeof RadioNodeList !== 'undefined' && field instanceof RadioNodeList;
            if (isRadioNodeList) {
                return;
            }

            if ('value' in field && field.value === '') {
                field.value = value;
                field.dispatchEvent(new Event('input', { bubbles: true }));
            }
        });
    } catch (error) {
        localStorage.removeItem(AUTO_SAVE_KEY);
    }
}

function showSaveIndicator() {
    const existingIndicator = document.querySelector('[data-save-indicator]');
    if (existingIndicator) {
        existingIndicator.remove();
    }

    const indicator = document.createElement('div');
    indicator.dataset.saveIndicator = 'true';
    indicator.className = 'toast toast-top toast-end';
    indicator.innerHTML = `
        <div class="alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Borrador guardado</span>
        </div>
    `;

    document.body.appendChild(indicator);

    window.setTimeout(() => {
        indicator.remove();
    }, 2000);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
