document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('living-expense-toggle-button');

    if (!toggleButton) return;

    toggleButton.addEventListener('click', async function () {
        const url = this.dataset.url;
        const csrfToken = window.moneyRecordToggleConfig?.csrfToken;

        this.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                alert(data.message ?? '更新に失敗しました。');
                return;
            }

            toggleButton.textContent = data.button_text;

            if (data.is_received) {
                toggleButton.classList.remove('received-button');
                toggleButton.classList.add('toggle-back-button');
            } else {
                toggleButton.classList.remove('toggle-back-button');
                toggleButton.classList.add('received-button');
            }
        } catch (error) {
            alert('通信エラーが発生しました。');
        } finally {
            toggleButton.disabled = false;
        }
    });
});