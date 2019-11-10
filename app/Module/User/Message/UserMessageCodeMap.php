<?php

/**
 * License: MIT Iran-2019
 *
 * @category Message
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Message;

use App\Module\Application\Message\MessageCodeMap;

class UserMessageCodeMap extends MessageCodeMap {

    const AddUserSuccess = [
        'type' => 'success',
        'content' => "Add User Success"
    ];

    const NameIsEmpty = [
        'type' => 'error',
        'content' => "Name Is Empty"
    ];

    const EmailIsWorng = [
        'type' => 'error',
        'content' => "Email Is Worng"
    ];

    const PasswordIsWorng = [
        'type' => 'error',
        'content' => "Password Is Worng"
    ];

    const UsernameOrPasswordIsWorng = [
        'type' => 'error',
        'content' => "Username Or Password Is Worng"
    ];

    const EmailUniqueError = [
        'type' => 'error',
        'content' => "Email Unique Error"
    ];

    const UserBeforeRegister = [
        'type' => 'error',
        'content' => "User Before Register"
    ];

}