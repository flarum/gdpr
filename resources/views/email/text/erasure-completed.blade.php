@extends('flarum.forum::email.plain.notification.base')

@section('notificationContent')
{!! $translator->trans("flarum-gdpr.email.erasure_completed.{$mode}.body", [
    "{display_name}" => $username
]) !!}
@endsection
