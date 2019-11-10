<?php

/**
 * License: MIT Iran-2019
 *
 * @category User
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.Arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Model\Service;

use App\Module\User\Model\Repository\UserRepositoryInterface;

interface UserModelServiceInterface
{
    /**
     * @return UserRepositoryInterface
     */
    public function getUserRepository();

}