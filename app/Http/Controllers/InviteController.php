<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\UserInvitation;
use App\Models\Invitation;
use App\Models\User;

class InviteController extends Controller
{
    public function index()
    {
        return view('admin.invites');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500'
        ], [
            'email.unique' => 'A user with this email address already exists.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.'
        ]);

        try {
            // Generate signed URL valid for 24 hours
            $signedUrl = URL::temporarySignedRoute(
                'register',
                now()->addHours(24),
                ['email' => $validated['email']]
            );

            // Send invitation email
            Mail::to($validated['email'])->send(new UserInvitation(
                $validated['email'],
                $validated['name'] ?? null,
                $validated['message'] ?? null,
                $signedUrl,
                auth()->user()
            ));

            // Log the invitation
            Log::info('Invitation sent', [
                'to_email' => $validated['email'],
                'to_name' => $validated['name'],
                'sent_by' => auth()->user()->email,
                'signed_url' => $signedUrl
            ]);

            // Optional: Store invitation in database for tracking
            $this->storeInvitation($validated, $signedUrl);

            return redirect()->back()->with('success',
                "Invitation sent successfully to {$validated['email']}! The registration link is valid for 24 hours."
            );

        } catch (\Exception $e) {

            Log::error('Failed to send invitation', [
                'email' => $validated['email'],
                'error' => $e->getMessage(),
                'sent_by' => auth()->user()->email
            ]);

            return redirect()->back()->with('error',
                'Failed to send invitation. Please try again or contact support.'
            )->withInput();
        }
    }

    private function storeInvitation(array $validated, string $signedUrl): void
    {
        try {
            Invitation::create([
                'email' => $validated['email'],
                'name' => $validated['name'],
                'message' => $validated['message'],
                'signed_url' => $signedUrl,
                'invited_by' => auth()->id(),
                'expires_at' => now()->addHours(24),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            // Log but don't fail the invitation process
            Log::warning('Failed to store invitation record', [
                'email' => $validated['email'],
                'error' => $e->getMessage()
            ]);
        }
    }
}
