Hey {!! $user->display_name !!}!

You requested an export of your data. This export has been successfully been generated and is now available:

{!! app()->url() !!}/gdpr/export/{!! $blueprint->export->file !!}

This export will remain available until {!! $blueprint->export->destroys_at !!}.
