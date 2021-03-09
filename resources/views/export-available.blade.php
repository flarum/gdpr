{!! $translator->trans('blomstra-gdpr.email.export_available.body', [
    "{display_name}" => $user->display_name,
    "{url}" => $url->to('forum')->route('gdpr.export', ['file' => $blueprint->getSubject()->file]),
    "{destroys_at}" => $blueprint->getSubject()->destroys_at
]) !!}
