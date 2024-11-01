@extends('flarum.forum::email.plain.information.base')

@section('informationContent')
{!! $translator->trans('flarum-gdpr.email.erasure_cancelled.body', [
    "{display_name}" => $user->display_name
]) !!}
@endsection
