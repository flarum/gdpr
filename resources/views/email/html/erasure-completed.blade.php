@extends('flarum.forum::email.html.information.base')

@section('informationContent')
  {!! $translator->trans("flarum-gdpr.email.erasure_completed.{$mode}.body", [
    "{display_name}" => $username
]) !!}
@endsection
