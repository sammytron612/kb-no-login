{{-- filepath: resources/views/emails/article-rejected.blade.php --}}
<x-mail::message>
# Your Article Has Been Rejected

Hello **{{ $author->name }}**,

We regret to inform you that your article has been reviewed and **rejected** by admin.

<x-mail::panel>
## {{ $article->title }}

**Status:****Rejected**

**Reviewed on:** {{ now()->format('M j, Y \a\t g:i A') }}
**Article KB:** `{{ $article->kb }}`

@if(isset($rejectionReason) && $rejectionReason)
**Rejection Reason:** {{ $rejectionReason }}
@endif
</x-mail::panel>

We understand this may be disappointing. Please review the feedback and consider making the necessary improvements before resubmitting.

<x-mail::button :url="$articleUrl" color="error">
View Article Details
</x-mail::button>

## What's Next?

- Review the feedback provided by the admin
- Make necessary revisions to address the concerns
- Resubmit your article for another review
- Contact admin if you need clarification on the rejection

<x-mail::button :url="$articleUrl .'/' . $article->id . '/edit'" color="primary">
Edit & Resubmit Article
</x-mail::button>

Best regards,<br>
Admin

<x-mail::subcopy>
You're receiving this email because you authored an article that has been rejected.
If you have questions about this decision, please contact the admin team.
</x-mail::subcopy>
</x-mail::message>

