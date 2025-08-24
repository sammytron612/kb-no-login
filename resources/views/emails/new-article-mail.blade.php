{{-- filepath: resources/views/emails/new-article-notification.blade.php --}}
<x-mail::message>
Hello **{{ $user->name }}**,

A New Knowledge Base Article: {{ $article->title }} has been published by {{ $article->authorUser->name }}.




To view this article click:
<x-mail::button :url="$articleUrl" color="primary">
Read Full Article
</x-mail::button>

<br>

Or click on the following link:<br>
{{ $articleUrl }}

Thanks


<x-mail::subcopy>
You're receiving this email because you have access to the knowledge base and notifications are enabled.
If you'd prefer not to receive these notifications, you can [update your preferences]({{ config('app.url') }}/profile/notifications) or contact your administrator.
</x-mail::subcopy>
</x-mail::message>
