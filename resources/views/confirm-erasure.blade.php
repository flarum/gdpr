{!! $translator->trans('blomstra-gdpr.email.export_available.body', [
    "{display_name}" => $user->display_name,
    "{erasure_confirm_url}" => $url->to('forum')->route('gdpr.erasure-confirm'),
]) !!}
