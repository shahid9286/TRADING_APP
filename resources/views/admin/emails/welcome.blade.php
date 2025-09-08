<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Trading App</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f5f7fa; padding: 20px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background: #ffffff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <tr>
            <td
                style="padding: 30px; text-align: center; background: #004085; color: #ffffff; border-radius: 10px 10px 0 0;">
                <h1 style="margin: 0;">Welcome, {{ $user->username }} 👋</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px; color: #333;">
                <p>Hi <strong>{{ $user->username }}</strong>,</p>
                <p>Thank you for signing up with <strong>Our Trading App</strong>.
                    We’re excited to have you onboard! 🚀</p>

                <p>With our platform, you can:</p>
                <ul>
                    <li>Trade securely and efficiently</li>
                    <li>Track your investments in real-time</li>
                    <li>Earn through our referral program</li>
                </ul>

                <p style="margin-top: 20px;">We’re here to support you on your trading journey.</p>
                <p>👉 <a href="{{ url('/deposit') }}"
                        style="background: #004085; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Start
                        Trading Now</a></p>

                <p style="margin-top: 30px;">Best Regards,<br>💼 The Trading App Team</p>
            </td>
        </tr>
    </table>
</body>

</html>
