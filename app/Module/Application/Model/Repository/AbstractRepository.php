<?php

/**
 * License: MIT Iran-2019
 *
 * @category Repository
 * @package	Application
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer 
 */

namespace App\Module\Application\Model\Repository;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Module\Application\Message\MessageCodeMap;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * @var String
     */
    protected $tableName;

    /**
     * @var \DateTime
     */
    protected $create_at;

    public function __construct(
    )
    {
        $this->create_at = (new \DateTime('now'))->format('Y-m-d H:i:s');
    }
    
    /**
     * @see \App\Module\Application\Model\Repository\AbstractRepositoryInterface::getItemById()
     */
    public function getItemById($itemId, $columns = ['*'])
    {
        $item = DB::table($this->tableName)
            ->select($columns)
            ->where('id', $itemId)
            ->first();

        return $item;
    }

    /**
     * @see \App\Module\Application\Model\Repository\AbstractRepositoryInterface::create()
     */
    public function create($columns)
    {
        $result = [
            'id' => 0,
            'exception' => null
        ];
        try {
            $result['id'] = DB::table($this->tableName)->insertGetId($columns);
            return $result;
        } catch (QueryException $e) {
            $result['exception'] = $e;
            return $result;
        }
    }

    /**
     * @see \App\Module\Application\Model\Repository\AbstractRepositoryInterface::addItem()
     */
    public function update($columns, $id)
    {
        $result = [
            'recordCount' => 0,
            'exception' => null
        ];
        try {
            $result['recordCount'] = DB::table($this->tableName)
                ->where('id', $id)
                ->update($columns);
            return $result;
        } catch (QueryException $e) {
            $result['exception'] = $e;
            return $result;
        }
    }

    /**
     * @see \App\Module\Application\Model\Repository\AbstractRepositoryInterface::deleteItem()
     */
    public function deleteItem($itemId)
    {
        try {
            $deleteId = DB::table($this->tableName)
                ->where([
                    'id' => $itemId,
                ])
                ->delete();

            return $deleteId;

        } catch (QueryException $e) {
            return MessageCodeMap::SystemError;
        }
    }

    protected function _addWhereUserId($query, $filters)
    {
        $userId = (int)$filters['user_id'];
        $query->where('user_id', $userId);
        return $query;
    }

}    