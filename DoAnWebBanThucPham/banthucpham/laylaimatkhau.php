<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lấy lại mật khẩu</h2>
        <form action="" method="POST">
            <label for="phone">Số điện thoại đã đăng ký</label>
            <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required>

            <label for="verification">Mã xác thực</label>
            <input type="number" id="verification" name="verification" placeholder="Nhập mã xác thực" required>

            <button type="submit">Gửi mã</button>
            <button type="submit">Xác nhận</button>
        </form>
        <div class="message">
            <!-- Nơi để hiển thị thông báo thành công hoặc lỗi nếu có -->
        </div>
    </div>
</body>
</html>
