<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shared Article</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset styles */
        * { box-sizing: border-box; }
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.7;
            color: #1a202c;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            width: 100% !important;
            min-width: 100%;
        }

        /* Outlook-specific styles */
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        .ExternalClass * { line-height: 100%; }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f7fafc;
            padding: 60px 0;
        }

        .container {
            width: 640px;
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 60px 40px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .header p {
            margin: 16px 0 0 0;
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        .content {
            padding: 60px 40px;
            background-color: #ffffff;
        }

        .greeting {
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 600;
            letter-spacing: -0.3px;
        }

        .shared-by {
            background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
            padding: 32px;
            border-radius: 20px;
            margin: 40px 0;
            border-left: 6px solid #667eea;
            font-size: 16px;
            line-height: 1.6;
        }

        .shared-by .name {
            color: #667eea;
            font-weight: 700;
            font-size: 18px;
        }

        .article-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 40px;
            border-radius: 24px;
            margin: 50px 0;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .article-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px 24px 0 0;
        }

        .article-title {
            margin: 0 0 24px 0;
            font-size: 28px;
            color: #1a202c;
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .article-meta {
            margin-top: 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .meta-item {
            font-size: 15px;
            color: #4a5568;
            line-height: 1.5;
        }

        .meta-label {
            color: #2d3748;
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .meta-value {
            color: #4a5568;
            font-size: 16px;
            font-weight: 500;
        }

        .tags-section {
            grid-column: 1 / -1;
            margin-top: 20px;
        }

        .tag {
            background-color: #667eea;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-right: 8px;
            display: inline-block;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .personal-message {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            padding: 32px;
            border-radius: 20px;
            margin: 40px 0;
            border-left: 6px solid #f59e0b;
        }

        .personal-message h4 {
            margin: 0 0 16px 0;
            color: #92400e;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .personal-message p {
            margin: 0;
            color: #92400e;
            font-style: italic;
            font-size: 16px;
            line-height: 1.6;
        }

        .button-wrapper {
            text-align: center;
            margin: 60px 0;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            padding: 20px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .security-notice {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 2px solid #f59e0b;
            padding: 32px;
            border-radius: 20px;
            margin: 40px 0;
            text-align: center;
        }

        .security-notice .icon {
            width: 48px;
            height: 48px;
            background-color: #f59e0b;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        .security-notice h4 {
            color: #92400e;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .security-notice p {
            margin: 0;
            color: #92400e;
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: #a0aec0;
            padding: 40px;
            text-align: center;
        }

        .footer .app-name {
            font-weight: 700;
            color: #ffffff;
            font-size: 20px;
            margin-bottom: 16px;
            letter-spacing: -0.3px;
        }

        .footer .disclaimer {
            font-size: 14px;
            margin-top: 20px;
            border-top: 1px solid #4a5568;
            padding-top: 20px;
            line-height: 1.6;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%);
            margin: 50px 0;
            border: none;
        }

        /* Mobile responsiveness */
        @media only screen and (max-width: 680px) {
            .container {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                border-radius: 0 !important;
            }
            .email-wrapper { padding: 20px 10px !important; }
            .header { padding: 40px 24px !important; }
            .content { padding: 40px 24px !important; }
            .footer { padding: 32px 24px !important; }
            .article-meta { grid-template-columns: 1fr !important; gap: 16px !important; }
            .button {
                padding: 18px 32px !important;
                font-size: 15px !important;
                display: block !important;
                width: 240px !important;
                margin: 0 auto !important;
            }
            .article-title { font-size: 24px !important; }
            .greeting { font-size: 20px !important; }
        }
    </style>
</head>
<body>
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f7fafc;">
        <tr>
            <td>
    <![endif]-->

    <div class="email-wrapper">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="container" style="width: 640px; max-width: 640px; background-color: #ffffff; border-radius: 24px;">

                        <!-- Header -->
                        <tr>
                            <td class="header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; padding: 60px 40px; text-align: center;">
                                <h1 style="margin: 0; font-size: 32px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">Knowledge Shared</h1>
                                <p style="margin: 16px 0 0 0; font-size: 18px; color: rgba(255, 255, 255, 0.9); font-weight: 400;">Someone has shared valuable content with you</p>
                            </td>
                        </tr>

                        <!-- Content -->
                        <tr>
                            <td class="content" style="padding: 60px 40px; background-color: #ffffff;">

                                <div class="greeting" style="font-size: 24px; color: #2d3748; margin-bottom: 40px; text-align: center; font-weight: 600; letter-spacing: -0.3px;">
                                    Hello there!
                                </div>

                                <div class="shared-by" style="background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%); padding: 32px; border-radius: 20px; margin: 40px 0; border-left: 6px solid #667eea; font-size: 16px; line-height: 1.6;">
                                    <span class="name" style="color: #667eea; font-weight: 700; font-size: 18px;">{{ $sharedBy->name }}</span> has shared a valuable knowledge base article with you and thought you might find it interesting.
                                </div>

                                <div class="article-card" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 40px; border-radius: 24px; margin: 50px 0; border: 1px solid #e2e8f0; position: relative;">
                                    <h3 class="article-title" style="margin: 0 0 24px 0; font-size: 28px; color: #1a202c; font-weight: 700; line-height: 1.3; letter-spacing: -0.5px;">{{ $article->title }}</h3>

                                    <div class="article-meta" style="margin-top: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div class="meta-item" style="font-size: 15px; color: #4a5568; line-height: 1.5;">
                                            <span class="meta-label" style="color: #2d3748; font-weight: 600; display: block; margin-bottom: 4px; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Author</span>
                                            <span class="meta-value" style="color: #4a5568; font-size: 16px; font-weight: 500;">{{ $article->author_name }}</span>
                                        </div>
                                        <div class="meta-item" style="font-size: 15px; color: #4a5568; line-height: 1.5;">
                                            <span class="meta-label" style="color: #2d3748; font-weight: 600; display: block; margin-bottom: 4px; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Section</span>
                                            <span class="meta-value" style="color: #4a5568; font-size: 16px; font-weight: 500;">{{ $article->section ? $article->section->section : 'General' }}</span>
                                        </div>
                                        <div class="meta-item" style="font-size: 15px; color: #4a5568; line-height: 1.5;">
                                            <span class="meta-label" style="color: #2d3748; font-weight: 600; display: block; margin-bottom: 4px; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Published</span>
                                            <span class="meta-value" style="color: #4a5568; font-size: 16px; font-weight: 500;">{{ $article->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="meta-item" style="font-size: 15px; color: #4a5568; line-height: 1.5;">
                                            <span class="meta-label" style="color: #2d3748; font-weight: 600; display: block; margin-bottom: 4px; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">Views</span>
                                            <span class="meta-value" style="color: #4a5568; font-size: 16px; font-weight: 500;">{{ number_format($article->views ?? 0) }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if($customMessage)
                                    <div class="personal-message" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); padding: 32px; border-radius: 20px; margin: 40px 0; border-left: 6px solid #f59e0b;">
                                        <h4 style="margin: 0 0 16px 0; color: #92400e; font-size: 18px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Personal Note</h4>
                                        <p style="margin: 0; color: #92400e; font-style: italic; font-size: 16px; line-height: 1.6;">"{{ $customMessage }}"</p>
                                    </div>
                                @endif

                                <hr class="divider" style="height: 1px; background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%); margin: 50px 0; border: none;">

                                <!-- Button Section -->
                                <div class="button-wrapper" style="text-align: center; margin: 60px 0;">
                                    <!--[if mso]>
                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $signedUrl }}" style="height:60px;v-text-anchor:middle;width:240px;" arcsize="50%" stroke="f" fillcolor="#667eea">
                                        <w:anchorlock/>
                                        <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">READ ARTICLE</center>
                                    </v:roundrect>
                                    <![endif]-->
                                    <!--[if !mso]><!-->
                                    <a href="{{ $signedUrl }}" class="button" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff !important; padding: 20px 40px; text-decoration: none; border-radius: 50px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px;">READ ARTICLE</a>
                                    <!--<![endif]-->
                                </div>

                                <div class="security-notice" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 2px solid #f59e0b; padding: 32px; border-radius: 20px; margin: 40px 0; text-align: center;">
                                    <div class="icon" style="width: 48px; height: 48px; background-color: #f59e0b; border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: white; font-weight: bold;">!</div>
                                    <h4 style="color: #92400e; font-size: 20px; font-weight: 700; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 0.5px;">Secure Access</h4>
                                    <p style="margin: 0; color: #92400e; font-size: 16px; line-height: 1.6;">This link will expire in 24 hours for your security and privacy.</p>
                                </div>

                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td class="footer" style="background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%); color: #a0aec0; padding: 40px; text-align: center;">
                                <div class="app-name" style="font-weight: 700; color: #ffffff; font-size: 20px; margin-bottom: 16px; letter-spacing: -0.3px;">{{ config('app.name') }} Knowledge Base</div>
                                <p class="disclaimer" style="margin: 0; font-size: 14px; margin-top: 20px; border-top: 1px solid #4a5568; padding-top: 20px; line-height: 1.6;">
                                    This email was sent because {{ $sharedBy->name }} wanted to share knowledge with you.<br>
                                    If you did not expect this email, you can safely ignore it.
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!--[if mso | IE]>
            </td>
        </tr>
    </table>
    <![endif]-->
</body>
</html>
