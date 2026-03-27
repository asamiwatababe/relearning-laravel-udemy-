<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お金管理一覧</title>
    <style>
        body {
            margin: 0;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #eef2ff);
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .title {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .subtitle {
            margin-top: 8px;
            color: #666;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            background: #4f46e5;
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .button:hover {
            opacity: 0.9;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .summary-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 28px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            overflow: hidden;
            border-radius: 16px;
        }

        th,
        td {
            padding: 16px 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f3f4f6;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .allowance {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .living {
            background: #dcfce7;
            color: #15803d;
        }

        .status-ok {
            color: #16a34a;
            font-weight: bold;
        }

        .status-ng {
            color: #dc2626;
            font-weight: bold;
        }

        .empty-message {
            text-align: center;
            color: #777;
            padding: 30px 0 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div>
                    <h1 class="title">お金管理一覧</h1>
                    <p class="subtitle">お小遣いと生活費の受け取り状況を確認できます</p>
                </div>
                <a href="{{ route('money-records.create') }}" class="button">＋ 新規登録</a>
            </div>

            <div class="summary">
                <div class="summary-box">
                    <div class="summary-label">今月の生活費チェック</div>
                    <div class="summary-value">80,000円</div>
                </div>
                <div class="summary-box">
                    <div class="summary-label">お小遣い記録</div>
                    <div class="summary-value">0件</div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>種類</th>
                        <th>金額</th>
                        <th>日付</th>
                        <th>メモ</th>
                        <th>受け取り状況</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($moneyRecords as $moneyRecord)
                    <tr>
                        <td>
                            @if ($moneyRecord->type === 'allowance')
                            <span class="badge allowance">お小遣い</span>
                            @else
                            <span class="badge living">生活費</span>
                            @endif
                        </td>
                        <td>{{ number_format($moneyRecord->amount) }}円</td>
                        <td>{{ $moneyRecord->record_date }}</td>
                        <td>{{ $moneyRecord->note }}</td>
                        <td>
                            @if ($moneyRecord->is_received)
                            <span class="status-ok">受け取り済み</span>
                            @else
                            <span class="status-ng">未確認</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-message">まだ記録がありません。</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <p class="empty-message">あとでここにデータベースの内容を表示できるようにします。</p>
        </div>
    </div>
</body>

</html>