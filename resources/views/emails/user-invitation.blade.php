<!-- filepath: c:\Users\Kevin\kb-new\resources\views\emails\user-invitation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Knowledge Base Invitation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f7fafc; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 40px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; font-weight: bold; }
        .header p { margin: 10px 0 0 0; opacity: 0.9; font-size: 16px; }
        .content { padding: 40px 30px; }
        .greeting { font-size: 18px; margin-bottom: 20px; color: #374151; }
        .message-box { background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #3b82f6; }
        .cta-button { display: inline-block; background: #3b82f6; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; transition: background 0.3s; }
        .cta-button:hover { background: #2563eb; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 30px 0; }
        .info-item { background: #f9fafb; padding: 15px; border-radius: 8px; border: 1px solid #e5e7eb; }
        .info-item h4 { margin: 0 0 5px 0; color: #374151; font-size: 14px; }
        .info-item p { margin: 0; color: #6b7280; font-size: 12px; }
        .footer { background: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; border-top: 1px solid #e5e7eb; }
        .security-note { background: #fef3c7; border: 1px solid #f59e0b; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .security-note h4 { margin: 0 0 10px 0; color: #92400e; }
        .security-note p { margin: 0; color: #92400e; font-size: 14px; }
        .url-box { background: #f3f4f6; padding: 10px; border-radius: 4px; word-break: break-all; font-family: monospace; font-size: 12px; color: #374151; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 You're Invited!</h1>
            <p>Join our Knowledge Base community</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hello{{ $userName ? ' ' . $userName : '' }}! 👋
            </div>

            <p><strong>{{ $sender->name }}</strong> has invited you to join our Knowledge Base platform where you can access valuable resources, contribute articles, and collaborate with the team.</p>

            @if($personalMessage)
                <div class="message-box">
                    <h4 style="margin: 0 0 10px 0; color: #374151;">💬 Personal Message:</h4>
                    <p style="margin: 0; color: #4b5563; font-style: italic;">"{{ $personalMessage }}"</p>
                </div>
            @endif

            <p>To create your account and get started, simply click the button below:</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $registrationUrl }}" class="cta-button">
                    🚀 Create My Account
                </a>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <h4>🔐 Secure Access</h4>
                    <p>Your invitation is cryptographically signed and secure</p>
                </div>
                <div class="info-item">
                    <h4>⏰ Valid for 24 Hours</h4>
                    <p>This invitation expires on {{ now()->addHours(24)->format('M j, Y \a\t g:i A') }}</p>
                </div>
                <div class="info-item">
                    <h4>📚 Knowledge Base</h4>
                    <p>Access articles, tutorials, and team resources</p>
                </div>
                <div class="info-item">
                    <h4>🤝 Collaborate</h4>
                    <p>Contribute your knowledge and help others</p>
                </div>
            </div>

            <div class="security-note">
                <h4>🔒 Security Notice</h4>
                <p>This invitation link is unique to you and expires in 24 hours. If you didn't expect this invitation or have security concerns, please contact our support team.</p>
            </div>

            <p>If the button doesn't work, you can copy and paste this link into your browser:</p>
            <div class="url-box">
                {{ $registrationUrl }}
            </div>
        </div>

        <div class="footer">
            <p>This invitation was sent by <strong>{{ $sender->name }}</strong> ({{ $sender->email }})</p>
            <p>If you have any questions, feel free to reach out to our support team.</p>
            <p style="margin-top: 20px; font-size: 12px; color: #9ca3af;">
                This email was sent on {{ now()->format('M j, Y \a\t g:i A') }}
            </p>
        </div>
    </div>
</body>
</html>
