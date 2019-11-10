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

namespace App\Module\User\Service;

use Illuminate\Support\Facades\Validator;

class UserValidationService implements UserValidationServiceInterface
{

    public function checkValidName($name)
    {
        $validator = Validator::make(['name' => $name], [
            'name' => [
                'required',
                'max:255'
            ]
        ]);

        if($validator->fails()) {
            return false;
        }
        return true;
    }

    public function checkValidEmail($email)
    {
        $validator = Validator::make(['email' => $email], [
            'email' => [
                'required',
                'max:255',
                'email'
            ]
        ]);

        if($validator->fails()) {
            return false;
        }
        return true;
    }

    public function checkValidPassword($password)
    {
        $validatorPassword = Validator::make(['password' => $password], [
            'password' => [
                'required',
                'min:3',
            ]
        ]);

        if($validatorPassword->fails()) {
            return false;
        }
        return true;
    }


}