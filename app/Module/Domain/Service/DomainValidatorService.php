<?php

/**
 * License: MIT Iran-2019
 *
 * @category Domain
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\Domain\Service;

use Illuminate\Support\Facades\Validator;

class DomainValidatorService implements DomainValidatorServiceInterface
{

    public function checkColumnsValid($columns)
    {
        if(!(strlen(trim($columns['url'])) > 1)) {
            return false;
        }

        if(!filter_var($columns['url'], FILTER_VALIDATE_DOMAIN)) {
            return false;
        }

        return true;
    }

}