<div class="summary-box living-expense-box">
    <div class="summary-label">生活費チェック</div>

    <div class="summary-value" id="living-expense-amount">
        {{ number_format($currentMonthLivingExpense->amount) }}円
    </div>

    <p
        id="living-expense-status"
        class="{{ $currentMonthLivingExpense->is_received ? 'status-ok' : 'status-ng' }}">
        {{ $currentMonthLivingExpense->is_received ? '受取済み' : '未確認' }}
    </p>

    <button
        type="button"
        id="living-expense-toggle-button"
        class="button {{ $currentMonthLivingExpense->is_received ? 'toggle-back-button' : 'received-button' }}"
        data-url="{{ route('money-records.toggle-received-ajax', $currentMonthLivingExpense) }}">
        {{ $currentMonthLivingExpense->is_received ? '未確認に戻す' : '受け取った' }}
    </button>
</div>