{{-- filepath: resources/views/emails/new-article-notification.blade.php --}}
<x-mail::message>
# New Knowledge Base Article

Hello {{ $user->name }},

{{ $article->author_name }} has just published a new article in the knowledge base:

<x-mail::panel>
## {{ $article->title }}

**Section:** {{ $article->section ? $article->section->section : 'No section' }}
**Author:** {{ $article->author_name }}
**Published:** {{ $article->created_at->format('M j, Y \a\t g:i A') }}
**KB ID:** {{ $article->kb }}

@if($article->tags && count($article->tags) > 0)
**Tags:** {{ implode(', ', $article->tags) }}
@endif
</x-mail::panel>

@if($article->body && $article->body->body)
@php
use Illuminate\Support\Str;
@endphp

**Article Preview:**
{{ Str::limit(strip_tags($article->body->body), 150) }}

---
@endif

<x-mail::button :url="$articleUrl" color="primary">
Read Full Article
</x-mail::button>

**Share this article:**
{{ $articleUrl }}

Best regards,
Knowledge Base Team

<x-mail::subcopy>
You received this email because a new article was published to the knowledge base.
</x-mail::subcopy>
</x-mail::message>
