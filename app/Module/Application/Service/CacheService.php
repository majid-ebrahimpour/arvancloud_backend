<?php

/**
 * License: MIT Iran-2019
 *
 * @category Application
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.Arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\Application\Service;

use Illuminate\Support\Facades\Redis;

class CacheService implements CacheServiceInterface
{

    public function __construct(

    ) {

    }

    /**
     * @see \App\Module\Application\Service\CacheServiceInterface::exists()
     */
    public function exists($key)
    {
        return Redis::exists($key);
    }

    public function set($key, $value)
    {
        $value = json_encode($value);
        Redis::set($key, $value);
    }

    public function get($key)
    {
        return Redis::get($key);
    }

    public function remove($key)
    {
        if($this->exists($key)) {
            Redis::del($key);
        }
    }

}