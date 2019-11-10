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

namespace App\Module\Domain\Model\Service;

use App\Module\Domain\Model\Repository\DomainRepository;

class DomainModelService implements DomainModelServiceInterface
{
    /**
     * @see \App\Module\Domain\Model\Service\DomainModelServiceInterface::getDomainRepository()
     */
    public function getDomainRepository()
    {
        return new DomainRepository();
    }
}