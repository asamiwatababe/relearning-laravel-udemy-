<div class="summary-box living-expense-box">
    <div class="summary-label">🏠 生活費チェック</div>

    <div class="summary-value" id="living-expense-amount">
        {{ number_format($currentMonthLivingExpense->amount) }}円
    </div>

    @if (session('is_admin'))
        <button
            type="button"
            id="living-expense-toggle-button"
            class="button {{ $currentMonthLivingExpense->is_received ? 'toggle-back-button' : 'received-button' }}"
            data-url="{{ route('money-records.toggle-received-ajax', $currentMonthLivingExpense) }}"
        >
            {{ $currentMonthLivingExpense->is_received ? '未受け取りに戻す' : '受け取り済にする' }}
        </button>
    @else
        <div class="living-expense-status">
            @if ($currentMonthLivingExpense->is_received)
                <span class="status-badge status-received">✅ 受け取り済</span>
            @else
                <span class="status-badge status-pending">⏳ 未受け取り</span>
            @endif
        </div>
    @endif
</div>
