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

use App\Module\Application\Model\Repository\AbstractRepository;
use Illuminate\Support\Facades\DB;

class DomainRepository extends AbstractRepository implements DomainRepositoryInterface
{
    /**
     * @var string $tableName
     */
    protected $tableName = 'domain';

    /**
     * @see \App\Module\Domain\Model\Repository\DomainRepositoryInterface::getList()
     */
    public function getList($userId)
    {
        $query = DB::table($this->tableName)
            ->select('domain.id', 'domain.user_id', 'domain.title', 'domain.status_id', 'domain.url',
                'domain.create_at')
            ->leftJoin('user', function ($join) {
                $join->on('domain.user_id', '=', 'user.id');
            })
            ->where('domain.user_id', $userId)
            ->orderBy('domain.create_at', 'DESC');
        return $query->get();
    }
}