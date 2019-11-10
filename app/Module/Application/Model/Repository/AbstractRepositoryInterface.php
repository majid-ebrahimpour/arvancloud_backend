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

interface AbstractRepositoryInterface
{

    /**
     * return table object by itemId
     * @param integer $itemId
     * @return Object
     */
    public function getItemById($itemId);

    /**
     * save item to DB
     * @param array $columns
     * @return integer item id
     */
    public function create($columns);

    /**
     * delete item from DB
     * @param integer $itemId
     * @return array|mixed
     */
    public function deleteItem($itemId);

}