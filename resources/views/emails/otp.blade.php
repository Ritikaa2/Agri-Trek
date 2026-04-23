<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7f5; padding: 20px;">
    <div style="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md border-top: 4px solid #10b981;">
        <h2 style="color: #064e3b; text-align: center;">AgriTrek Account Recovery</h2>
        <p style="color: #374151;">Hello,</p>
        <p style="color: #374151;">You recently requested to reset your password for your Agri-Trek account. Use the 6-digit OTP below to proceed with resetting your password.</p>
        
        <div style="background-color: #f1f5f9; padding: 15px; border-radius: 8px; text-align: center; margin: 20px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #10b981;">{{ $otp }}</span>
        </div>

        <p style="color: #374151;">This OTP is valid for the next 10 minutes. If you did not request a password reset, please ignore this email or contact support.</p>
        <p style="color: #374151; margin-top: 30px;">Regards,<br>The AgriTrek Security Team</p>
    </div>
</body>
</html>
