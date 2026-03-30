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
            <label for="user_id">👤 ユーザー</label>
            <select name="user_id" id="user_id">
                <option value="">選択してください</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $choreRecord->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="chore_id">🧹 お手伝い</label>
            <select name="chore_id" id="chore_id">
                <option value="">選択してください</option>
                @foreach ($chores as $chore)
                    <option value="{{ $chore->id }}" {{ old('chore_id', $choreRecord->chore_id ?? '') == $chore->id ? 'selected' : '' }}>
                        {{ $chore->category }} / {{ $chore->name }}
                    </option>
                @endforeach
            </select>
            @error('chore_id')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="record_date">📅 日付</label>
            <input
                type="date"
                name="record_date"
                id="record_date"
                value="{{ old('record_date', isset($choreRecord) ? \Carbon\Carbon::parse($choreRecord->record_date)->format('Y-m-d') : date('Y-m-d')) }}"
                max="{{ date('Y-m-d') }}"
            >
            @error('record_date')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-area">
            <a href="{{ route('chore-records.index') }}" class="button button-secondary">一覧へ戻る</a>
            <button type="submit" class="button">{{ $submitLabel }}</button>
        </div>
    </form>
</div>