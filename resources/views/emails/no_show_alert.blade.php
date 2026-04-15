<x-mail::message>
# Hello {{ $appointment->customer_name }},

We missed you today at your scheduled appointment for **{{ $appointment->service?->name }}** on **{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('F d, Y \a\t h:i A') }}**.

We reserved this specific time slot for you, and since you were unable to attend, our stylists missed the opportunity to serve other clients.

Please let us know if you had an emergency or if you would like to reschedule. You can view your appointment status and details in your dashboard.

<x-mail::button :url="route('client_main')">
View Dashboard
</x-mail::button>

**Important Note:** Repeat no-shows may lead to a temporary or permanent suspension of your booking privileges to ensure fairness for all our clients.

Thanks,<br>
**Tonet Salon Management Team**
</x-mail::message>
