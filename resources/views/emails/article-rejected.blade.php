<!-- filepath: c:\Users\Kevin\kb-new\resources\views\emails\article-rejected.blade.php -->
@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article Needs Attention</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px; }
        .article-info { background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #f59e0b; margin: 20px 0; }
        .button { display: inline-block; background: #f59e0b; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .meta { color: #666; font-size: 14px; margin: 10px 0; }
        .footer { text-align: center; color: #666; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Article Needs Attention</h1>
            <p>Your article submission requires some updates before publication</p>
        </div>

        <div class="content">
            <p>Hello {{ $author->name }},</p>

            <p>Thank you for your contribution to our knowledge base. Your article has been reviewed, but it needs some updates before it can be published.</p>

            <div class="article-info">
                <h2 style="margin-top: 0; color: #333;">{{ $article->title }}</h2>

                <div class="meta">
                    <p><strong>📁 Section:</strong> {{ $article->section ? $article->section->section : 'No section' }}</p>
                    <p><strong>📅 Submitted:</strong> {{ $article->created_at->format('M j, Y \a\t g:i A') }}</p>
                    <p><strong>🏷️ KB ID:</strong> {{ $article->kb }}</p>
                </div>
            </div>

            <p>Please review and update your article, then resubmit it for approval. You can make the necessary changes by clicking the button below.</p>

            <div style="text-align: center;">
                <a href="{{ $articleUrl }}" class="button">✏️ Edit Article</a>
            </div>

            <p style="margin-top: 30px;">Best regards,<br>Knowledge Base Admin Team</p>
        </div>

        <div class="footer">
            <p>We appreciate your contribution and look forward to publishing your updated article.</p>
        </div>
    </div>
</body>
</html>
