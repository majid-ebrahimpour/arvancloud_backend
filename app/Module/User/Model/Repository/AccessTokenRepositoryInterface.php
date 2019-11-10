<?php

/**
 * License: MIT Iran-2019
 *
 * @category AccessToken
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.Arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Model\Repository;

interface AccessTokenRepositoryInterface
{
    /**
     * set access token for user
     * @param integer $userId
     * @param string $accessTokenString
     * @return boolean
     */
    public function setAccessToken($userId, $accessTokenString);

    /**
     * return user id
     * @param string $accessTokenString
     * @return integer|null
     */
    public function getUserId($accessTokenString);
}