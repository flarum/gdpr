<x-mail::plain.information>
<x-slot:body>
{!! $translator->trans('flarum-gdpr.email.erasure_cancelled.body', [
    "{display_name}" => $user->display_name
]) !!}
</x-slot:body>
</x-mail::plain.information>
