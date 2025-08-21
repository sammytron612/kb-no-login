<!-- filepath: c:\Users\Kevin\kb-new\resources\views\emails\new-article-notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Article Notification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px; }
        .article-info { background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #667eea; margin: 20px 0; }
        .button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .meta { color: #666; font-size: 14px; margin: 10px 0; }
        .footer { text-align: center; color: #666; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
     @php
        use Illuminate\Support\Str;
    @endphp
    <div class="container">
        <div class="header">
            <h1>📄 New Knowledge Base Article</h1>
            <p>A new article has been published to the knowledge base</p>
        </div>

        <div class="content">
            <p>Hello {{ $user->name }},</p>

            <p>{{ $article->author_name }} has just published a new article in the knowledge base:</p>

            <div class="article-info">
                <h2 style="margin-top: 0; color: #333;">{{ $article->title }}</h2>

                <div class="meta">
                    <p><strong>📁 Section:</strong> {{ $article->section ? $article->section->section : 'No section' }}</p>
                    <p><strong>👤 Author:</strong> {{ $article->author_name }}</p>
                    <p><strong>📅 Published:</strong> {{ $article->created_at->format('M j, Y \a\t g:i A') }}</p>
                    <p><strong class="uppercase">🏷️ KB ID:</strong> {{ $article->kb }}</p>

                    @if($article->tags && count($article->tags) > 0)
                        <p><strong>🏷️ Tags:</strong> {{ implode(', ', $article->tags) }}</p>
                    @endif
                </div>

                @if($article->body && $article->body->body)
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0;">
                        <strong>Preview:</strong><br>
                        {{ Str::limit(strip_tags($article->body->body), 200) }}
                    </div>
                @endif
            </div>

            <div style="text-align: center;">
                <a href="{{ $articleUrl }}" class="button">📖 Read Full Article</a>
            </div>

            <p style="margin-top: 30px;">Best regards,<br>Knowledge Base Team</p>
        </div>

        <div class="footer">
            <p>You received this email because a new article was published to the knowledge base.</p>
        </div>
    </div>
</body>
</html>
