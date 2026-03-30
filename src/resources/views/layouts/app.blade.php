<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お金管理アプリ')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: #f0f2ff;
            color: #1e1b4b;
            min-height: 100vh;
        }

        /* ── Header ── */
        .app-header {
            background: linear-gradient(135deg, #6c63ff 0%, #9b59f5 50%, #c471ed 100%);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.35);
        }

        .app-header-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .app-logo {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .app-nav {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .app-nav a {
            text-decoration: none;
            color: rgba(255,255,255,0.85);
            font-weight: 600;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 999px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .app-nav a:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        .app-nav-logout {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.35);
            color: rgba(255,255,255,0.85);
            font-weight: 600;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 999px;
            cursor: pointer;
            transition: 0.2s;
        }

        .app-nav-logout:hover {
            background: rgba(255,255,255,0.28);
            color: #fff;
        }

        .hamburger-button {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            cursor: pointer;
            padding: 0;
            align-items: center;
            justify-content: center;
        }

        .hamburger-icon {
            position: relative;
            width: 20px;
            height: 14px;
            display: inline-block;
        }

        .hamburger-icon span {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background: #fff;
            border-radius: 999px;
            transition: 0.25s;
        }

        .hamburger-icon span:nth-child(1) { top: 0; }
        .hamburger-icon span:nth-child(2) { top: 6px; }
        .hamburger-icon span:nth-child(3) { top: 12px; }

        .hamburger-button.is-open .hamburger-icon span:nth-child(1) {
            top: 6px;
            transform: rotate(45deg);
        }
        .hamburger-button.is-open .hamburger-icon span:nth-child(2) { opacity: 0; }
        .hamburger-button.is-open .hamburger-icon span:nth-child(3) {
            top: 6px;
            transform: rotate(-45deg);
        }

        /* ── Page container ── */
        .page-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(108, 99, 255, 0.1);
        }

        /* ── Page title ── */
        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #6c63ff, #c471ed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            margin-top: 6px;
            color: #8b8ba7;
            font-size: 14px;
        }

        /* ── Buttons ── */
        .button {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            background: linear-gradient(135deg, #6c63ff, #9b59f5);
            color: #fff;
            padding: 12px 24px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.35);
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.45);
        }

        .button:active {
            transform: translateY(0);
        }

        .button-secondary {
            background: #f3f4f6;
            color: #4b5563;
            box-shadow: none;
        }

        .button-secondary:hover {
            background: #e5e7eb;
            box-shadow: none;
        }

        /* ── Alerts ── */
        .error-text {
            color: #f43f5e;
            font-size: 13px;
            margin-top: 6px;
        }

        .error-box {
            background: linear-gradient(135deg, #fff0f3, #ffe4e8);
            color: #be123c;
            border: 1px solid #fda4af;
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-box {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            color: #15803d;
            border: 1px solid #86efac;
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* ── Mobile ── */
        @media screen and (max-width: 767px) {
            .app-header-inner {
                flex-wrap: wrap;
            }

            .hamburger-button {
                display: inline-flex;
            }

            .app-nav {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 6px;
                padding-top: 10px;
                padding-bottom: 4px;
            }

            .app-nav.is-open {
                display: flex;
            }

            .app-nav a {
                width: 100%;
                justify-content: center;
                text-align: center;
                background: rgba(255,255,255,0.15);
                color: #fff;
            }

            .page-container {
                margin: 20px auto;
                padding: 0 12px;
            }

            .card {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <header class="app-header">
        <div class="app-header-inner">
            <a href="{{ route('money-records.index') }}" class="app-logo">💰 お金管理アプリ</a>

            <button
                type="button"
                class="hamburger-button"
                id="hamburger-button"
                aria-label="メニューを開く"
                aria-expanded="false"
                aria-controls="app-nav">
                <span class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <nav class="app-nav" id="app-nav">
                <a href="{{ route('money-records.index') }}">📋 お小遣い一覧</a>
                <a href="{{ route('chore-records.index') }}">🧹 お手伝いポイント</a>
                @if (session('is_admin'))
                    <a href="{{ route('admin.index') }}">⚙️ 管理画面</a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="app-nav-logout">🔓 ログアウト</button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}">🔐 管理者ログイン</a>
                @endif
            </nav>
        </div>
    </header>

    <main class="page-container">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('hamburger-button');
            const nav = document.getElementById('app-nav');

            if (!button || !nav) return;

            button.addEventListener('click', function() {
                const isOpen = nav.classList.toggle('is-open');
                button.classList.toggle('is-open', isOpen);
                button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>