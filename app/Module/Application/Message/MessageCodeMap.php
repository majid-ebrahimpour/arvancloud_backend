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

namespace App\Module\Application\Message;

class MessageCodeMap {

    const SystemError = [
        'type' => 'error',
        'content' => "System Error"
    ];

    const ValidatorError = [
        'type' => 'error',
        'content' => "Validator Error"
    ];

}