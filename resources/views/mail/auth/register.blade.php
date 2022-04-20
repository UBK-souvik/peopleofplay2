@component('mail::message')
Thank you for register on Player of play
@component('mail::button', ['url' => $url])
Login to website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
