# GDPR or PII management

This extension allows users increasing control over their data.

### Installation or update

Install manually with composer:

```sh
composer require blomstra/gdpr:@beta
```

### Use

The user has a new button in their settings - account section called "Export Data". Upon clicking this button a modal
will appear showing that user data can be exported. Once the export has been generated the user is notified through email
with a unique, temporary link.

### For developers

You can easily register a new Data type by implementing the Contract `Blomstra\Gdpr\Contracts\DataType`
and then using the extender `Blomstra\Gdpr\Extend\UserData`:

```php
<?php

use Blomstra\Gdpr\Extend\UserData;
use Your\Own\DataType;

return [
    (new UserData())
        ->addType(DataType::class)
];
```

The implementation you create needs a export method, it will receive a ZipArchive resource.
You can use that to add any strings or actual files to the archive. Make sure to properly
name the file and always prefix it with your extension slug (blomstra-something-filename).

### FAQ & Recommendations

- Generating the zip archive can be pushed to [queue functionality](https://extiverse.com/?filter[q]=queue). This is exceptionally important on larger communities and with more extensions that work with the gdpr extension to allow data exports.

### Links

- [Packagist](https://packagist.org/packages/blomstra/flarum-ext-gdpr)
- [GitHub](https://github.com/blomstra/flarum-ext-gdpr)

---

- Blomstra provides managed Flarum hosting.
- https://blomstra.net
- https://blomstra.community/t/ext-gdpr
