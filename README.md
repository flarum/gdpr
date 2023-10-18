# GDPR or PII management

This extension allows users increasing control over their data.

### Installation or update

Install manually with composer:

```sh
composer require blomstra/gdpr:@beta
```

### Use

All forum users now have a `Personal Data` section within their account settings page:

![image](https://github.com/blomstra/flarum-ext-gdpr/assets/16573496/4e469956-709f-4ba3-a5fe-d3fcb0401b73)

From here, users may self-service export their data from the forum, or start an erasure request. Erasure requests are queued up for admins/moderators to process. Any unprocessed requests that are still pending after 30 days will be processed automatically using the configured default method (Deletion or Anonymization).

#### Specifying which queue to use
If your forum runs multiple queues, ie `low` and `high`, you may specify which queue jobs for this extension are run on in your skeleton's `extend.php` file:

```php
Blomstra\Gdpr\Jobs\GdprJob::$onQueue = 'low';

return [
    ... your current extenders,
];
```

### For developers

You can easily register a new Data type, remove an existing Data type, or exclude specific columns from the user table during export by leveraging the `Blomstra\Gdpr\Extend\UserData` extender.

#### Registering a new Data Type:

Your data type class should implement the `Blomstra\Gdpr\Contracts\DataType`:
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

#### Removing a Data Type:
If for any reason you want to exclude a certain DataType from the export:
```php
use Blomstra\Gdpr\Extend\UserData;

return [
    (new UserData())
        ->removeType(Your\Own\DataType::class)
];
```

#### Exclude specific columns from the user table during export:
```php
use Blomstra\Gdpr\Extend\UserData;

return [
    (new UserData())
        ->removeUserColumn('column_name') // For a single column
        ->removeUserColumns(['column1', 'column2']) // For multiple columns
];
```

### FAQ & Recommendations

- Generating the zip archive can be pushed to [queue functionality](https://extiverse.com/?filter[q]=queue). This is exceptionally important on larger communities and with more extensions that work with the gdpr extension to allow data exports.

### Links

- [Packagist](https://packagist.org/packages/blomstra/flarum-ext-gdpr)
- [GitHub](https://github.com/blomstra/flarum-ext-gdpr)

---

- Blomstra provides managed Flarum hosting.
- https://blomstra.net
- https://blomstra.community/t/ext-gdpr
