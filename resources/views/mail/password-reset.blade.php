<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px;">
        <h2 style="color:#000;">Password Reset Request</h2>
        <p>Hello {{ $user->first_name ?? 'there' }},</p>
        <p>You requested a password reset for your <strong>Oasis Vista Hub</strong> account.</p>
        <p style="padding:20px 10px">
            <a href="{{ $resetUrl }}" style="background:#000;color:#fff;padding:10px 15px;text-decoration:none;border-radius:5px;">
                Reset My Password
            </a>
        </p>
        <p>If you didn’t request this, just ignore this email.</p>
        <p style="color:#555;">Thanks,<br>The Oasis Vista Hub Team</p>
    </div>
</body>
</html>
