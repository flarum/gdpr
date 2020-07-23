<?php

namespace Bokt\Gdpr;

use Bokt\Gdpr\Contracts\DataType;
use Carbon\Carbon;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use ZipArchive;

class Exporter
{
    protected static $types = [
        Data\Assets::class, Data\Posts::class
    ];
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct()
    {
        $this->settings = app('flarum.settings');
    }

    static public function addType(string $type)
    {
        static::$types[] = $type;
    }

    public function export(User $user): string
    {
        $file = tempnam(app()->storagePath() . DIRECTORY_SEPARATOR . 'tmp', 'gdpr-export-' . $user->username);
        $zip = new ZipArchive;
        $now = Carbon::now();

        $zip->open($file);
        $zip->setArchiveComment("Export of user data for {$user->username} ({$user->email}) on $now. From: {$this->settings->get('forum_title')}.");

        foreach (static::$types as $type) {
            /** @var DataType $segment */
            $segment = new $type($user);

            $segment->export($zip);
        }

        $zip->close();

        return $file;
    }
}
