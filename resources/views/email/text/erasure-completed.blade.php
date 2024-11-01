@extends('flarum.forum::email.plain.information.base')

@section('informationContent')
{!! $translator->trans("flarum-gdpr.email.erasure_completed.{$mode}.body", [
    "{display_name}" => $username
]) !!}
@endsection
