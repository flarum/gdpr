<?php

namespace Blomstra\Gdpr;

use PhpZip\ZipFile;

class ZipManager
{
    private ZipFile $zip;

    public function __construct()
    {
        $this->zip = new ZipFile();
    }

    /**
     * Add data to the ZIP file.
     *
     * @param string $filename The name of the file inside the ZIP.
     * @param string $data The actual data/content of the file.
     */
    public function addData(string $filename, string $data): void
    {
        $this->zip->addFromString($filename, $data);
    }

    public function setComment(string $comment): void
    {
        $this->zip->setArchiveComment($comment);
    }

    /**
     * Save the ZIP file to the specified path.
     *
     * @param string $path Path where the ZIP should be saved.
     */
    public function save(string $path): void
    {
        $this->zip->saveAsFile($path);
        $this->zip->close();
    }
}
