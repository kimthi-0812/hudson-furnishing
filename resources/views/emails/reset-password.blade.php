<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 50px;
        }
        h2 {
            color: #333333;
            text-align: center;
        }
        p {
            color: #555555;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            background-color: #43727F;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            font-size: 12px;
            color: #999999;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{ isset($siteSettings['logo']) && $siteSettings['logo']
                 ? Storage::url($siteSettings['logo']) 
                 : asset('images/logo.png') }}">
        </div>

        <h2>Đặt lại mật khẩu</h2>

        <p>Xin chào {{ $user->name ?? 'Người dùng' }},</p>

        <p>Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>

        <p style="text-align:center;">
            <a href="{{ $resetUrl }}" class="btn">Đặt lại mật khẩu</a>
        </p>

        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.</p>

        <div class="footer">
            © {{ date('Y') }} Hudson Furnishing. All rights reserved.
        </div>
    </div>
</body>
</html>
