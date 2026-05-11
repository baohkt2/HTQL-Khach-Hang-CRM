<?php
http_response_code(503);
header('Content-Type: text/html; charset=UTF-8');
header('Retry-After: 3600');

$estimatedCompletionTime = '06:00';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo nâng cấp hệ thống</title>
    <style>
        :root {
            --bg-1: #f7f4ec;
            --bg-2: #ebe4d3;
            --card: #fffdf8;
            --ink: #1c2a30;
            --muted: #4f5f66;
            --accent: #0c7c59;
            --accent-soft: #d9f2e8;
            --border: #d8d2c3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at 10% 20%, rgba(12, 124, 89, 0.12), transparent 40%),
                radial-gradient(circle at 85% 15%, rgba(193, 137, 43, 0.14), transparent 45%),
                linear-gradient(165deg, var(--bg-1), var(--bg-2));
            font-family: "Segoe UI", "Tahoma", sans-serif;
            color: var(--ink);
            padding: 24px;
        }

        .notice {
            width: min(680px, 100%);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px;
            background: var(--card);
            box-shadow: 0 18px 55px rgba(17, 23, 28, 0.16);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-soft);
            color: var(--accent);
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(12, 124, 89, 0.18);
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(24px, 4vw, 34px);
            line-height: 1.2;
        }

        p {
            margin: 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
        }

        .eta {
            margin-top: 18px;
            display: inline-block;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 17px;
            font-weight: 700;
            background: #ffffff;
        }

        .eta strong {
            color: var(--accent);
        }

        .foot {
            margin-top: 20px;
            font-size: 14px;
            color: #6d777b;
        }
    </style>
</head>
<body>
    <main class="notice" role="main" aria-live="polite">
        <span class="status"><span class="dot" aria-hidden="true"></span>Đang nâng cấp</span>
        <h1>Hệ thống tạm thời bảo trì để nâng cấp</h1>
        <p>
            Xin lỗi vì sự bất tiện. Chúng tôi đang nâng cấp hệ thống để cải thiện tốc độ và độ ổn định.
            Vui lòng quay lại sau ít phút.
        </p>
        <div class="eta">
            Dự kiến hoàn thành vào lúc: <strong><?php echo htmlspecialchars($estimatedCompletionTime, ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
        <p class="foot">Cảm ơn bạn đã thông cảm và chờ đợi.</p>
    </main>
</body>
</html>
