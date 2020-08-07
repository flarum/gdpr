<?php

namespace Bokt\Gdpr;

use Bokt\Gdpr\Contracts\DataType;
use Bokt\Gdpr\Models\Export;
use Carbon\Carbon;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Filesystem;
use Laminas\Diactoros\Response;
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
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->settings = app('flarum.settings');
        $this->filesystem = $filesystem;
    }

    static public function addType(string $type)
    {
        static::$types[] = $type;
    }

    public function export(User $user): Export
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

        $this->filesystem->writeStream($user->id, $zip->getStream());

        return Export::exported($user, $file);
    }

    public function getZip(Export $export)
    {
        return new Response(
            $this->filesystem->readStream($export->user->id),
            200,
            [
                'Content-Type' => 'application/zip',
                'Content-Length' => $this->filesystem->size($export->user->id),
                'Content-Disposition' => 'attachment; filename="gdpr-data-' . $export->user->username . '-' . $export->created_at->toIso8601String() . '.zip"'
            ]
        );
    }
}
