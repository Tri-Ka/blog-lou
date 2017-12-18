<?php

namespace AppBundle\Services;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Unpacking.
 */
class CoverService
{
    const COVER_FOLDER = 'images/global/';
    const COVER_NAME = 'cover_custom.png';

    /**
     * Save cover.
     *
     * @param array $formDatas
     */
    public function saveCover($formDatas)
    {
        $cover = $formDatas['cover']->getPathname();

        $fs = new Filesystem();
        $customFileName = self::COVER_FOLDER.self::COVER_NAME;
        if (file_exists($customFileName)) {
            $fs->remove($customFileName);
        }
        $fs->copy($cover, $customFileName);

        return true;
    }

    /**
     * Delete cover.
     */
    public function deleteCover()
    {
        $fs = new Filesystem();
        $customFileName = self::COVER_FOLDER.self::COVER_NAME;

        if (file_exists($customFileName)) {
            $fs->remove($customFileName);
        }

        return true;
    }

    /**
     * get website cover.
     *
     * @return string
     */
    public function getCover()
    {
        return self::COVER_FOLDER.self::COVER_NAME;
    }
}
