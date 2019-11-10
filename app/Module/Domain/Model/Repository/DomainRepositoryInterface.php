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

namespace App\Module\Domain\Model\Repository;

use App\Module\Application\Model\Repository\AbstractRepositoryInterface;

interface DomainRepositoryInterface extends AbstractRepositoryInterface
{

    /**
     * @param int $userId
     * @return mixed
     */
    public function getList($userId);
}