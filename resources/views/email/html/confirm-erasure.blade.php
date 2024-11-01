@extends('flarum.forum::email.html.information.base')

@section('informationContent')
  {!! $translator->trans('flarum-gdpr.email.confirm_erasure.body', [
    "{display_name}" => $user->display_name,
    "{erasure_confirm_url}" => $url->to('forum')->route('gdpr.erasure.confirm', ["token" => $blueprint->getSubject()->verification_token]),
]) !!}
@endsection
