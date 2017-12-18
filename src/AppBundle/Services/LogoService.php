<?php

namespace AppBundle\Services;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Unpacking.
 */
class LogoService
{
    const LOGO_FOLDER = 'images/global/';
    const LOGO_NAME = 'logo_custom.png';

    /**
     * Save logo.
     *
     * @param array $formDatas
     */
    public function saveLogo($formDatas)
    {
        $logo = $formDatas['logo']->getPathname();

        $fs = new Filesystem();
        $customFileName = self::LOGO_FOLDER.self::LOGO_NAME;
        if (file_exists($customFileName)) {
            $fs->remove($customFileName);
        }
        $fs->copy($logo, $customFileName);

        return true;
    }

    /**
     * Delete logo.
     */
    public function deleteLogo()
    {
        $fs = new Filesystem();
        $customFileName = self::LOGO_FOLDER.self::LOGO_NAME;

        if (file_exists($customFileName)) {
            $fs->remove($customFileName);
        }

        return true;
    }

    /**
     * get website logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return self::LOGO_FOLDER.self::LOGO_NAME;
    }
}
