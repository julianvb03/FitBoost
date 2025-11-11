export function autoHideAlerts(timeout = 5000) {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((alert) => {
        window.setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            window.setTimeout(() => {
                alert.remove();
            }, 500);
        }, timeout);
    });
}
