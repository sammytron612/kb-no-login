{{-- filepath: resources/views/emails/new-article-notification.blade.php --}}
<x-mail::message>
Hello,

A New Knowledge Base Article: {{ $article->title }} has been shared to you by {{ $sharedBy }}.




To view this article click:
<x-mail::button :url="$signedUrl" color="primary">
Read Full Article
</x-mail::button>

<br>
Or click on the following link:<br>
{{ $signedUrl }}
<br>

**Note:** This invitation expires on {{ now()->addHours(24)->format('M j, Y \a\t g:i A')  }}


Thanks
{{$sharedBy}}


<x-mail::subcopy>
You're receiving this email because you have access to the knowledge base and notifications are enabled.
</x-mail::subcopy>
</x-mail::message>
