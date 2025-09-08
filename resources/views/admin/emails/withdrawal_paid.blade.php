<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Withdrawal Paid</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <tr>
            <td
                style="padding: 20px; text-align: center; background: #28a745; color: #fff; border-radius: 10px 10px 0 0;">
                <h2>Withdrawal Paid ✅</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px; color: #333;">
                <p>Hi <strong>{{ $user->username }}</strong>,</p>
                <p>Your withdrawal request <strong>#{{ $withdrawal_request->id }}</strong> has been successfully paid.
                </p>

                <p><strong>Details:</strong></p>
                <ul>
                    <li>Requested Amount: ${{ number_format($withdrawal_request->requested_amount, 2) }}</li>
                    <li>Fee: ${{ number_format($withdrawal_request->fee, 2) }}</li>
                    <li>Payout: ${{ number_format($withdrawal_request->payout_amount, 2) }}</li>
                    <li>Transaction ID: {{ $withdrawal_request->transaction_id }}</li>
                    <li>Payout Date: {{ $withdrawal_request->payout_date->format('d M, Y h:i A') }}</li>
                </ul>

                <p style="margin-top: 20px;">💼 Thank you for using our trading platform!</p>

                <p style="margin-top: 30px;">Best Regards,<br><strong>The Admin Team</strong></p>
            </td>
        </tr>
    </table>
</body>

</html>
