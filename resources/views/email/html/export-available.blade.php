@extends('flarum.forum::email.html.information.base')

@section('informationContent')
  {!! $translator->trans('flarum-gdpr.email.export_available.body', [
    "{display_name}" => $user->display_name,
    "{url}" => $url->to('forum')->route('gdpr.export', ['file' => $blueprint->getSubject()->file]),
    "{username}" => $blueprint->getFromUser()->username,
    "{destroys_at}" => $blueprint->getSubject()->destroys_at
]) !!}
@endsection
