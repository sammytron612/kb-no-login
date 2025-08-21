<!-- filepath: c:\Users\Kevin\kb-new\resources\views\emails\article-approved.blade.php -->
@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px; }
        .article-info { background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #10b981; margin: 20px 0; }
        .button { display: inline-block; background: #10b981; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .meta { color: #666; font-size: 14px; margin: 10px 0; }
        .footer { text-align: center; color: #666; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Article Approved!</h1>
            <p>Congratulations! Your article has been approved and published</p>
        </div>

        <div class="content">
            <p>Hello {{ $author->name }},</p>

            <p>Great news! Your article has been reviewed and <strong>approved</strong> for publication in the knowledge base.</p>

            <div class="article-info">
                <h2 style="margin-top: 0; color: #333;">{{ $article->title }}</h2>

                <div class="meta">
                    <p><strong>📁 Section:</strong> {{ $article->section ? $article->section->section : 'No section' }}</p>
                    <p><strong>📅 Approved:</strong> {{ now()->format('M j, Y \a\t g:i A') }}</p>
                    <p><strong>🏷️ KB ID:</strong> {{ $article->kb }}</p>

                    @if($article->tags && count($article->tags) > 0)
                        <p><strong>🏷️ Tags:</strong> {{ implode(', ', $article->tags) }}</p>
                    @endif
                </div>
            </div>

            <p>Your article is now live and accessible to all users. Thank you for contributing to our knowledge base!</p>

            <div style="text-align: center;">
                <a href="{{ $articleUrl }}" class="button">📖 View Published Article</a>
            </div>

            <p style="margin-top: 30px;">Best regards,<br>Knowledge Base Admin Team</p>
        </div>

        <div class="footer">
            <p>Keep up the great work! Your contributions help make our knowledge base valuable for everyone.</p>
        </div>
    </div>
</body>
</html>
