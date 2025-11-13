<?php
// File: vtigercrm/modules/CTFacebookMessengerIntegration/redirect.php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facebook Redirect</title>
    <script>
        // Kiểm tra nếu Facebook trả về access_token qua hash (#)
        const fragment = window.location.hash.substring(1);
        const params = new URLSearchParams(fragment);
        const accessToken = params.get("access_token");

        if (accessToken) {
            // Gửi token này về server PHP (nếu cần lưu session)
            fetch("save_token.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "access_token=" + accessToken
            }).then(() => {
                // Sau khi lưu xong, redirect về trang chính
                // window.location.href = "https://shonta-miry-nobuko.ngrok-free.dev/vtigercrm/index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTFacebookMessengerIntegrationList";

                window.location.href = "https://shonta-miry-nobuko.ngrok-free.dev/vtigercrm/index.php?module=CTChatLog&view=ChatBox&mode=allChats";
            });
        } else {
            document.body.innerHTML = "<h3>Không tìm thấy access_token.</h3>";
        }
    </script>
</head>
<body>
    <p>Đang xử lý đăng nhập Facebook...</p>
</body>
</html>