@component('mail::message')
 # Hello {{ $order->user->name }} ,

Your order is now #{{ $order->id }} has been updated please.

@component('mail::button', ['url' => '/login'])
Login
@endcomponent

 to see full details.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
