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

use App\Module\Application\Model\Repository\AbstractRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    protected $tableName = 'user';

    /**
     * @see \App\Module\User\Model\Repository\UserRepositoryInterface::getUserWithUsername()
     */
    public function getUserWithUsername($username)
    {
        $user = DB::table($this->tableName)
            ->select('id', 'email', 'password', 'status_id')
            ->where('email', $username)
            ->first();

        return $user;
    }

    /**
     * @see \App\Module\User\Model\Repository\UserRepositoryInterface::getUserIdWithUsername()
     */
    public function getUserIdWithUsername($username)
    {
        $user = DB::table($this->tableName)
            ->select('id')
            ->where('email', $username)
            ->first();

        return $user;
    }

    /**
     * @see \App\Module\User\Model\Repository\UserRepositoryInterface::fetch()
     */
    public function fetch($id)
    {
        $user = DB::table($this->tableName)
            ->select('user.id', 'user.name', 'user.email', 'user.status_id')
            ->where('user.id', $id)
            ->first();

        return $user;
    }

}