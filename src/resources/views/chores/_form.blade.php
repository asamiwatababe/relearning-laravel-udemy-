<div class="card form-card">
    <h1 class="page-title">{{ $title }}</h1>
    <p class="page-subtitle">{{ $subtitle }}</p>

    @if ($errors->any())
        <div class="error-box">入力内容を確認してください。</div>
    @endif

    <form action="{{ $action }}" method="POST">
        @csrf
        @isset($method)
            @method($method)
        @endisset

        <div class="form-group">
            <label for="category">📂 カテゴリ</label>
            <input
                type="text"
                name="category"
                id="category"
                value="{{ old('category', $chore->category ?? '') }}"
                placeholder="例: 掃除、料理、洗濯"
            >
            @error('category')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">🧹 お手伝い名</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $chore->name ?? '') }}"
                placeholder="例: 皿洗い、掃き掃除"
            >
            @error('name')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="points">⭐ ポイント</label>
            <input
                type="number"
                name="points"
                id="points"
                value="{{ old('points', $chore->points ?? 10) }}"
                min="1"
                max="1000"
            >
            @error('points')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-area">
            <a href="{{ route('chores.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">{{ $submitLabel }}</button>
        </div>
    </form>
</div>
