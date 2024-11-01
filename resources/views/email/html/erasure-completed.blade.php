@extends('flarum.forum::email.html.notification.base')

@section('notificationContent')
  {!! $translator->trans("flarum-gdpr.email.erasure_completed.{$mode}.body", [
    "{display_name}" => $username
]) !!}
@endsection

{{--@section('contentPreview')--}}
{{--    <!-- Optional content -->--}}
{{--@endsection--}}
