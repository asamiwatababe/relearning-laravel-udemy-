<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お金管理アプリ')</title>
    <style>
        body {
            margin: 0;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #eef2ff);
            color: #333;
        }

        .app-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .app-header-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .app-logo {
            font-size: 22px;
            font-weight: bold;
            color: #4338ca;
            text-decoration: none;
        }

        .app-nav {
            display: flex;
            gap: 12px;
        }

        .app-nav a {
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .app-nav a:hover {
            background: #eef2ff;
            color: #4338ca;
        }

        .page-container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .page-title {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .page-subtitle {
            margin-top: 8px;
            color: #666;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            background: #4f46e5;
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .button:hover {
            opacity: 0.9;
        }

        .button-secondary {
            background: #e5e7eb;
            color: #333;
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

        .success-box {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
    </style>

    @yield('styles')
</head>

<body>
    <header class="app-header">
        <div class="app-header-inner">
            <a href="{{ route('money-records.index') }}" class="app-logo">お金管理アプリ</a>
            <nav class="app-nav">
                <a href="{{ route('money-records.index') }}">一覧</a>
                <a href="{{ route('money-records.create') }}">新規登録</a>
            </nav>
        </div>
    </header>

    <main class="page-container">
        @yield('content')
    </main>
</body>

</html>