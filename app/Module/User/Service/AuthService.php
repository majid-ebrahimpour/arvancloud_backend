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

use App\Module\User\Model\Service\AuthModelService;
use App\Module\User\Model\Service\AuthModelServiceInterface;
use App\Module\User\Message\UserMessageCodeMap;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    /**
     * @var AuthModelServiceInterface
     */
    protected $authModelService;

    /**
     * @var UserValidationServiceInterface
     */
    protected $userValidationService;

    /**
     * @var UserServiceInterface
     */
    protected $userService;

    public function __construct(

    ) {
        $this->authModelService = new AuthModelService();
        $this->userValidationService = new UserValidationService();
        $this->userService = new UserService();
    }

    /**
     * @see \App\Module\User\Service\AuthServiceInterface::signUp()
     */
    public function signUp($data)
    {
        $name = (isset($data['name'])) ? trim($data['name']) : null;
        $email = (isset($data['email'])) ? trim($data['email']) : null;
        $password = (isset($data['password'])) ? $data['password'] : null;

        if(!$this->userValidationService->checkValidName($name)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::NameIsEmpty
            ];
        }

        if(!$this->userValidationService->checkValidEmail($email)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::EmailIsWorng
            ];
        }

        if(!$this->userValidationService->checkValidPassword($password)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::PasswordIsWorng
            ];
        }

        $user = $this->authModelService->getUserRepository()->getUserIdWithUsername($email);
        if(!empty($user)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::UserBeforeRegister
            ];
        }

        $data['password'] = $this->generateHash($password);
        $result = $this->userService->create($data);
        if(!$result['done']) {
            return $result;
        }

        $currentUser = $result['user'];
        if (!empty($currentUser)) {
            $accessTokenString = $this->generateHash(time() . ' ' . $currentUser->email . ' ');
            $accessToken = $this->authModelService->getAccessTokenRepository()
                ->setAccessToken($currentUser->id, $accessTokenString);
            if ($accessToken) {
                $currentUser->token = $accessTokenString;
            }
            return [
                'done' => true,
                'user' => $currentUser,
                'message' => UserMessageCodeMap::AddUserSuccess
            ];
        }
        return [
            'done' => false,
            'message' => UserMessageCodeMap::SystemError
        ];
    }

    /**
     * @see \App\Module\User\Service\AuthServiceInterface::signIn()
     */
    public function signIn($data)
    {
        $email = (isset($data['email'])) ? trim($data['email']) : null;
        $password = (isset($data['password'])) ? $data['password'] : null;

        if(!$this->userValidationService->checkValidEmail($email)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::ValidatorError
            ];
        }

        if(!$this->userValidationService->checkValidPassword($password)) {
            return [
                'done' => false,
                'data' => [],
                'message' => UserMessageCodeMap::ValidatorError
            ];
        }

        $password = $this->_passSalt($password);
        $user = $this->authModelService->getUserRepository()->getUserWithUsername($email);
        if(!empty($user)) {
            if (Hash::check($password, $user->password)) {
                $accessTokenString = $this->generateHash(time() . ' ' . $email . ' ');
                $accessToken = $this->authModelService->getAccessTokenRepository()
                    ->setAccessToken($user->id, $accessTokenString);

                if ($accessToken) {
                    $currentUser = $this->userService->currentUser(['user_id' => $user->id]);
                    $user = $currentUser['user'];
                    $user->token = $accessTokenString;
                    return [
                        'done' => true,
                        'user' => $user
                    ];
                }
            }
        }
        return [
            'done' => false,
            'message' => UserMessageCodeMap::UsernameOrPasswordIsWorng
        ];
    }

    /**
     * @see \App\Module\User\Service\AuthServiceInterface::getUserId()
     */
    public function getUserId($accessTokenString)
    {
        return $this->authModelService->getAccessTokenRepository()->getUserId($accessTokenString);
    }

    public function generateHash($str)
    {
        return Hash::make($this->_passSalt($str));
    }

    private function _passSalt($str)
    {
        return '#$Mn_-'. $str .'!adW09*j';
    }
}