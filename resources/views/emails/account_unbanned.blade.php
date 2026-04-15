<x-mail::message>
# Hello {{ $user->name }},

Good news! Your account on the **Tonet Salon Management System** has been reactivated.

You can now log in and resume booking your favorite beauty treatments and services. We look forward to seeing you at the salon soon!

<x-mail::button :url="route('login')">
Log In to Your Account
</x-mail::button>

Thanks,<br>
**Tonet Salon Management Team**
</x-mail::message>
