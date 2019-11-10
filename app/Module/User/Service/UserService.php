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

use App\Module\Application\Model\Mapper\CfgStatusMap;
use App\Module\User\Model\Service\UserModelService;
use App\Module\User\Model\Service\UserModelServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserModelServiceInterface
     */
    protected $userModelService;

    public function __construct(

    ) {
        $this->userModelService = new UserModelService();
    }

    public function currentUser($params)
    {
        $userId = (int)$params['user_id'];
        $user = $this->userModelService->getUserRepository()->fetch($userId);
        return [
            'done' => true,
            'user' => $user
        ];
    }

    /**
     * @see \App\Module\User\Service\UserServiceInterface::create()
     */
    public function create($data)
    {
        $columns = [];
        $columns['name'] = (isset($data['name'])) ? trim($data['name']) : null;
        $columns['email'] = (isset($data['email'])) ? trim($data['email']) : null;
        $columns['password'] = (isset($data['password'])) ? trim($data['password']) : null;
        $columns['status_id'] = CfgStatusMap::STATUS_ACTIVE;
        $columns['create_at'] = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $columns['last_login_at'] = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $this->userModelService->getUserRepository()->create($columns);
        if(!(int)$result['id']) {
            return [
                'done' => false,
                'message' => $result['exception']->getMessage()
            ];
        }

        return $this->currentUser(['user_id' => $result['id']]);
    }


}