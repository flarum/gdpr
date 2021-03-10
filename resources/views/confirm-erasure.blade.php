{!! $translator->trans('blomstra-gdpr.email.confirm_erasure.body', [
    "{display_name}" => $user->display_name,
    "{erasure_confirm_url}" => $url->to('forum')->route('gdpr.erasure-confirm'),
]) !!}
