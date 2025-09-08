<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Withdrawal Request</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0" 
           style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding: 20px; text-align: center; background: #007bff; color: #fff; border-radius: 10px 10px 0 0;">
                <h2>New Withdrawal Request 🚨</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px; color: #333;">
                <p>Hello Admin,</p>
                <p>A new withdrawal request has been submitted by <strong>{{ $user->username }}</strong>.</p>
                
                <p><strong>Details:</strong></p>
                <ul>
                    <li>User Email: {{ $user->email }}</li>
                    <li>Bank Name: {{ $withdrawal_request->bank_name }}</li>
                    <li>Account No: {{ $withdrawal_request->account_no }}</li>
                    <li>Requested Amount: ${{ number_format($withdrawal_request->requested_amount, 2) }}</li>
                    <li>Request Date: {{ $withdrawal_request->request_date->format('d M, Y') }}</li>
                </ul>

                <p style="margin-top: 20px;">⚠️ Please review this withdrawal request in the admin panel.</p>

                <p style="margin-top: 30px;">Regards,<br><strong>Your Trading Platform</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>
