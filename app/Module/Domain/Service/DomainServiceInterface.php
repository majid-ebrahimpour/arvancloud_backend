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

interface DomainServiceInterface
{
    /**
     * create new domain
     * @param array $data
     * @param int $userId
     * @return mixed
     */
    public function create($data, $userId);

    /**
     * @param int $domainId
     * @param int $userId
     * @return mixed
     */
    public function get($domainId, $userId);

    /**
     * @param int $userId
     * @return mixed
     */
    public function getList($userId);

}