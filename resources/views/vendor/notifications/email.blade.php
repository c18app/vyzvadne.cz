@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# @lang('Chyba!')
@else
# @lang('Dobrý den!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line == 'You are receiving this email because we received a password reset request for your account.' ? 'Tento e-mail dostáváte, protože jsme obdrželi požadavek na obnovení hesla pro váš účet.' : $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText == 'Reset Password' ? 'Obnovit heslo' : $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line == 'If you did not request a password reset, no further action is required.' ? 'Pokud jste o obnovení hesla nepožádali, není třeba provádět žádné další akce.' : $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('S pozdravem'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang(
    "Pokud nefunguje tlačítko \":actionText\", zkopírujte URL uvedenou níže\n".
    'do vašeho webového prohlížeče: [:actionURL](:actionURL)',
    [
        'actionText' => (($actionText == 'Reset Password') ? 'Obnovit heslo' : $actionText),
        'actionURL' => $actionUrl
    ]
)
@endcomponent
@endisset
@endcomponent
