<?php

/**
 * License: MIT Iran-2019
 *
 * @category Auth
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Model\Service;

use App\Module\User\Model\Repository\AccessTokenRepository;
use App\Module\User\Model\Repository\UserRepository;
use App\Module\User\Service\UserService;
use App\Module\User\Service\VerificationCodeService;

class AuthModelService implements AuthModelServiceInterface
{
    /**
     * @see \App\Module\User\Model\Service\AuthModelServiceInterface::getUserRepository()
     */
    public function getUserRepository()
    {
        return new UserRepository();
    }

    /**
     * @see \App\Module\User\Model\Service\AuthModelServiceInterface::getAccessTokenRepository()
     */
    public function getAccessTokenRepository()
    {
        return new AccessTokenRepository();
    }

    /**
     * @see \App\Module\User\Model\Service\AuthModelServiceInterface::getUserService()
     */
    public function getUserService()
    {
        return new UserService();
    }
}