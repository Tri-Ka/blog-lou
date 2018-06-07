<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
    * Administrator role.
    */
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * Administrator role.
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * Basic role.
     */
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Return list of possibles roles.
     *
     * @return array
     */
    public static function getPossibleRoles()
    {
        return [
            self::ROLE_USER => 'user.role.label.user',
            self::ROLE_ADMIN => 'user.role.label.administrator',
            self::ROLE_SUPER_ADMIN => 'user.role.label.super.administrator',
        ];
    }
}
