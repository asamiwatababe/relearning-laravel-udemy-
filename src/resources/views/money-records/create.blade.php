<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お金記録の登録</title>
    <style>
        body {
            margin: 0;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #eef2ff);
            color: #333;
        }

        .container {
            max-width: 760px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .title {
            margin: 0 0 8px;
            font-size: 30px;
            font-weight: bold;
        }

        .subtitle {
            margin: 0 0 30px;
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input {
            width: auto;
        }

        .button-area {
            display: flex;
            gap: 14px;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            background: #4f46e5;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            flex: 1;
        }

        .button-secondary {
            background: #e5e7eb;
            color: #333;
        }

        .button:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="title">お金記録の登録</h1>
            <p class="subtitle">お小遣いまたは生活費の記録を追加します</p>

            <form action="{{ route('money-records.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="type">種類</label>
                    <select name="type" id="type">
                        <option value="allowance">お小遣い</option>
                        <option value="living_expense">生活費</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">金額</label>
                    <input type="number" name="amount" id="amount" placeholder="例: 80000">
                </div>

                <div class="form-group">
                    <label for="record_date">日付</label>
                    <input type="date" name="record_date" id="record_date">
                </div>

                <div class="form-group">
                    <label for="note">メモ</label>
                    <textarea name="note" id="note" placeholder="例: 4月分の生活費"></textarea>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="is_received" id="is_received" value="1">
                    <label for="is_received">受け取り済みにする</label>
                </div>

                <div class="button-area">
                    <a href="{{ route('money-records.index') }}" class="button button-secondary">一覧へ戻る</a>
                    <button type="submit" class="button">登録する</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お金記録の登録</title>
    <style>
        body {
            margin: 0;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #eef2ff);
            color: #333;
        }

        .container {
            max-width: 760px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .title {
            margin: 0 0 8px;
            font-size: 30px;
            font-weight: bold;
        }

        .subtitle {
            margin: 0 0 30px;
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input {
            width: auto;
        }

        .button-area {
            display: flex;
            gap: 14px;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            background: #4f46e5;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            flex: 1;
        }

        .button-secondary {
            background: #e5e7eb;
            color: #333;
        }

        .button:hover {
            opacity: 0.9;
        }

        .error-text {
            color: #dc2626;
            font-size: 14px;
            margin-top: 8px;
        }

        .error-box {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="title">お金記録の登録</h1>
            <p class="subtitle">お小遣いまたは生活費の記録を追加します</p>

            @if ($errors->any())
            <div class="error-box">
                入力内容を確認してください。
            </div>
            @endif

            <form action="{{ route('money-records.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="type">種類</label>
                    <select name="type" id="type">
                        <option value="">選択してください</option>
                        <option value="allowance" {{ old('type') === 'allowance' ? 'selected' : '' }}>お小遣い</option>
                        <option value="living_expense" {{ old('type') === 'living_expense' ? 'selected' : '' }}>生活費</option>
                    </select>
                    @error('type')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="amount">金額</label>
                    <input type="number" name="amount" id="amount" placeholder="例: 80000" value="{{ old('amount') }}">
                    @error('amount')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="record_date">日付</label>
                    <input type="date" name="record_date" id="record_date" value="{{ old('record_date') }}">
                    @error('record_date')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="note">メモ</label>
                    <textarea name="note" id="note" placeholder="例: 4月分の生活費">{{ old('note') }}</textarea>
                    @error('note')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="is_received" id="is_received" value="1" {{ old('is_received') ? 'checked' : '' }}>
                    <label for="is_received">受け取り済みにする</label>
                </div>

                <div class="button-area">
                    <a href="{{ route('money-records.index') }}" class="button button-secondary">一覧へ戻る</a>
                    <button type="submit" class="button">登録する</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>