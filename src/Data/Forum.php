<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Data;

use Carbon\Carbon;
use PhpZip\ZipFile;

class Forum extends Type
{
    public static function exportDescription(): string
    {
        return 'Exports the forum title, url, username, email and the current date.';
    }
    
    public function export(ZipFile $zip): void
    {
        $forumTitle = $this->settings->get('forum_title');
        $url = $this->url->to('forum')->base();

        $comment = $this->translator->trans('blomstra-gdpr.forum.export_file', [
            '{forumTitle}' => $forumTitle,
            '{url}'        => $url,
            '{username}'   => $this->user->username,
            '{email}'      => $this->user->email,
            '{date}'       => Carbon::now()->toDateTimeString(),
        ]);

        $zip->addFromString(
            "{$forumTitle}-{$this->user->username}.txt",
            $comment
        );

        $zip->setArchiveComment($comment);
    }

    public static function anonymizeDescription(): string
    {
        return self::NO_ACTION_TAKEN;
    }

    public function anonymize(): void
    {
        // Nothing to do
    }

    public static function deleteDescription(): string
    {
        return self::NO_ACTION_TAKEN;
    }

    public function delete(): void
    {
        // Nothing to do
    }
}
