<?php

/**
 * License: MIT Iran-2019
 *
 * @category AccessToken
 * @package	Arvancloud
 * @copyright Copyright (c) 2019 Arvancloud. (http://www.Arvancloud.developer)
 * @author Majid Ebrahimpour
 * @version 0.0.1
 * @link
 * @since	0.0.1
 * @reviewer
 */

namespace App\Module\User\Model\Repository;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    protected $tableName = 'access_token';

    /**
     * @var \DateTime $createAt
     */
    protected $nowDateTime;

    /**
     * @var \DateTime $expireAt
     */
    protected $expireAt;

    public function __construct()
    {
        $this->nowDateTime = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $this->expireAt = (new \DateTime('now'))->modify('+1 day')->format('Y-m-d H:i:s');
    }

    /**
     * @see \App\Module\User\Model\Repository\AccessTokenRepositoryInterface::setAccessToken()
     */
    public function setAccessToken($userId, $accessTokenString)
    {
        try {
            $accessTokenStringMd5 = md5($accessTokenString);
            $accessToken = DB::table($this->tableName)
                ->select('id')
                ->where('user_id', $userId)
                ->first();

            if (empty($accessToken)) {
                $accessTokenId = DB::table($this->tableName)->insertGetId([
                    'user_id' => $userId,
                    'access_token' => $accessTokenStringMd5,
                    'create_at' => $this->nowDateTime,
                    'expire_at' => $this->expireAt
                ]);
                if ((int)$accessTokenId > 0) {
                    return true;
                }
            }

            DB::table($this->tableName)
                ->where('user_id', $userId)
                ->update([
                    'access_token' => $accessTokenStringMd5,
                    'create_at' => $this->nowDateTime,
                    'expire_at' => $this->expireAt
                ]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * @see \App\Module\User\Model\Repository\AccessTokenRepositoryInterface::getUserId()
     */
    public function getUserId($accessTokenString)
    {
        $accessTokenStringMd5 = md5($accessTokenString);
        $accessToken = DB::table($this->tableName)
            ->select('user_id', 'expire_at')
            ->where('access_token', $accessTokenStringMd5)
            ->first();

        if (!empty($accessToken)) {
            if($accessToken->expire_at > $this->nowDateTime) {
                DB::table($this->tableName)
                    ->where('user_id', $accessToken->user_id)
                    ->update([
                        'expire_at' => $this->expireAt
                    ]);
                return $accessToken->user_id;
            }
        }
        return null;
    }

}