<div class="summary-box calendar-box">
    <div class="summary-label">📅 表示月</div>

    <form method="GET" action="{{ route('money-records.index') }}">
        <input
            type="month"
            name="month"
            value="{{ $selectedMonth }}"
            class="month-input"
            onchange="this.form.submit()">
    </form>
</div>