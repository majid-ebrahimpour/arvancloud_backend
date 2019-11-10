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

namespace App\Module\User\Service;

interface AuthServiceInterface
{
    
    /**
     * sign up user
     * @param array $params
     * @return array
     */
    public function signUp($params);

    /**
     * login user
     * @param array $params
     * @return array
     */
    public function signIn($params);

    /**
     * return user id from access token
     * @param string $accessTokenString
     * @return integer|null
     */
    public function getUserId($accessTokenString);

}