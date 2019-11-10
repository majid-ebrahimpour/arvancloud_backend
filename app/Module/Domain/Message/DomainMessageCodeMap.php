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

namespace App\Module\Domain\Message;

use App\Module\Application\Message\MessageCodeMap;

class DomainMessageCodeMap extends MessageCodeMap {

    const DomainNotFound = [
        'type' => 'error',
        'content' => 'Domain not found!!!'
    ];

    const YouArentAnyDomain = [
        'type' => 'error',
        'content' => 'You aren\'t any domain'
    ];

    const DomainNotVerify = [
        'type' => 'error',
        'content' => 'Domain not verify!!!'
    ];

}