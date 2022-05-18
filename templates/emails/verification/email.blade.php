@component('mail::message')
# Cher utilisateur,

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach
 
@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
{{ $actionText }}
@endcomponent

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

Cordialement,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si vous avez des difficultés à cliquer sur le bouton \":actionText\" , copier et coller l'URL ci-dessous\n".
    'dans votre navigateur web:',
    [
        'actionText' => $actionText,
    ]
)
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
