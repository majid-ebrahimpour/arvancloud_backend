<?php

/**
 * License: MIT Iran-2019
 *
 * @category User
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Model\Repository;

interface UserRepositoryInterface
{

    /**
     * get user by username
     * @param string $username
     * @return user
     */
    public function getUserWithUsername($username);

    /**
     * get user by id
     * @param int $id
     * @return user
     */
    public function getUserIdWithUsername($id);

    /**
     * @param integer $id
     * @return array|null
     */
    public function fetch($id);

}