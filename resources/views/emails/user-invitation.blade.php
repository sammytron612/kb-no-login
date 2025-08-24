{{-- filepath: resources/views/emails/user-invitation.blade.php --}}
<x-mail::message>
# You're Invited to Join the KB!

Hello {{ $user }},


<x-mail::button :url="$registrationUrl" color="success">
Accept Invitation
</x-mail::button>

## What You'll Get Access To:

- Browse and search our comprehensive knowledge base
- Contribute your own articles and expertise
- Collaborate with team members
- Access exclusive resources and documentation

<x-mail::panel>
**Your invitation link:**
{{ $registrationUrl }}
</x-mail::panel>


**Note:** This invitation expires on {{ now()->addHours(24)->format('M j, Y \a\t g:i A')  }}


We're excited to have you on board!

Best regards,<br>
Admin

<x-mail::subcopy>
You're receiving this email because admin invited you to join the KB.
If you don't want to accept this invitation, you can safely ignore this email.
</x-mail::subcopy>
</x-mail::message>
