# GDPR or PII management

This extension allows users increasing control over their data.

### Installation or update

Use [Bazaar](https://discuss.flarum.org/d/5151-flagrow-bazaar-the-extension-marketplace) or install manually with composer:

```sh
composer require bokt/flarum-gdpr
```

### Use

The user has a new button in their settings - account section called "Export Data". Upon clicking this button a modal
will appear showing that user data can be exported. Once the export has been generated the user is notified through email
with a unique, temporary link.

### For developers

You can easily register a new Data type by implementing the Contract `Bokt\Gdpr\Contracts\DataType`
and then using the extender `Bokt\Gdpr\Extend\UserData`:

```php
<?php

use Bokt\Gdpr\Extend\UserData;
use Your\Own\DataType;

return [
    new UserData(DataType::class)
];
```

The implementation you create needs a export method, it will receive a ZipArchive resource.
You can use that to add any strings or actual files to the archive. Make sure to properly
name the file and always prefix it with your extension slug (bokt-something-filename).

### Links

- [Packagist](https://packagist.org/packages/bokt/flarum-gdpr)
- [GitHub](https://github.com/bokt/flarum-gdpr)

### FAQ & Recommendations

- Generating the zip archive can be pushed to queue functionality. This is exceptionally important on larger communities and
with more extensions that work with the gdpr extension to allow data exports.

### Disclaimer

This extension is developed as an employee of @BartVB at Bokt. Bokt is the largest equine community in the Netherlands. We're currently moving a phpBB forum with over 100 million posts to Flarum. By keeping both in sync until we're more feature complete, we offer our users a slow transition to this fantastic new platform.
