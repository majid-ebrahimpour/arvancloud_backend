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

namespace App\Module\User\Service;

interface UserServiceInterface
{

    /**
     * return current user data
     * @param array $params
     * @return array
     */
    public function currentUser($params);

    /**
     * create new user
     * @param $data
     * @return mixed
     */
    public function create($data);

}