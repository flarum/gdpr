@extends('flarum.forum::email.html.notification.base')

@section('notificationContent')
  {!! $translator->trans('flarum-gdpr.email.erasure_cancelled.body', [
    "{display_name}" => $user->display_name
]) !!}
@endsection

{{--@section('contentPreview')--}}
{{--    <!-- Optional content -->--}}
{{--@endsection--}}
