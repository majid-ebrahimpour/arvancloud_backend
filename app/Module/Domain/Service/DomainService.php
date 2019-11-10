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

use App\Module\Domain\Message\DomainMessageCodeMap;
use App\Module\Domain\Model\Mapper\CfgDomainStatusMap;
use App\Module\Domain\Model\Service\DomainModelService;
use App\Module\Domain\Model\Service\DomainModelServiceInterface;

class DomainService implements DomainServiceInterface
{
    /**
     * @var DomainModelServiceInterface
     */
    protected $domainModelService;

    /**
     * @var DomainValidatorServiceInterface
     */
    protected $domainValidatorService;

    public function __construct() {
        $this->domainModelService = new DomainModelService();
        $this->domainValidatorService = new DomainValidatorService();
    }

    /**
     * @see \App\Module\Domain\Service\DomainServiceInterface::create()
     */
    public function create($data, $userId)
    {
        $columns = [];
        $columns['user_id'] = $userId;
        $columns['title'] = (isset($data['title'])) ? trim($data['title']) : '';
        $columns['url'] = (isset($data['url'])) ? trim($data['url']) : '';
        $columns['status_id'] = CfgDomainStatusMap::STATUS_PENDING;
        $columns['create_at'] = (new \DateTime('now'))->format('Y-m-d H:i:s');

        if(!$this->domainValidatorService->checkColumnsValid($columns)) {
            return [
                'done' => false,
                'message' => DomainMessageCodeMap::ValidatorError
            ];
        }

        if(!
            (strpos($columns['url'], 'http://', 0)
            || strpos($columns['url'], 'https://', 0))
        ) {
            $columns['url'] = 'http://' . $columns['url'];
        }

        $result = $this->domainModelService->getDomainRepository()->create($columns);
        if(!(int)$result['id']) {
            return [
                'done' => false,
                'message' => $result['exception']->getMessage()
            ];
        }

        $columns['id'] = $result['id'];
        return [
            'done' => true,
            'domain' => $columns
        ];
    }

    /**
     * @see \App\Module\Domain\Service\DomainServiceInterface::get()
     */
    public function get($domainId, $userId)
    {
        $domain = $this->domainModelService->getDomainRepository()->getItemById($domainId);
        if(empty($domain) || (!empty($domain) && $domain->user_id != $userId)) {
            return [
                'done' => false,
                'message' => DomainMessageCodeMap::DomainNotFound
            ];
        }
        $result = $this->_prepareDomainData($domain);
        return [
            'done' => true,
            'domain' => $result
        ];
    }

    /**
     * @see \App\Module\Domain\Service\DomainServiceInterface::getList()
     */
    public function getList($userId)
    {
        $domainList = $this->domainModelService->getDomainRepository()->getList($userId);
        if(empty($domainList)) {
            return [
                'done' => false,
                'message' => DomainMessageCodeMap::YouArentAnyDomain
            ];
        }

        $result = [];
        foreach ($domainList as $domain) {
            $result[] = $this->_prepareDomainData($domain);
        }

        return [
            'done' => true,
            'domain' => $result
        ];
    }

    /**
     * @see \App\Module\Domain\Service\DomainServiceInterface::verfify()
     */
    public function verfify($domainId, $userId)
    {
        try {
            $domain = $this->domainModelService->getDomainRepository()->getItemById($domainId);
            if (empty($domain) || (!empty($domain) && $domain->user_id != $userId)) {
                return [
                    'done' => false,
                    'message' => DomainMessageCodeMap::DomainNotFound
                ];
            }

            if ($domain->status_id === CfgDomainStatusMap::STATUS_PENDING) {
                $tags = get_meta_tags($domain->url);
                if (isset($tags["arvancloud-site-verification"])
                    && $tags["arvancloud-site-verification"] === "arvancloud-app"
                ) {
                    $domain->status_id = CfgDomainStatusMap::STATUS_ACTIVE;
                    $this->domainModelService->getDomainRepository()->update([
                        'status_id' => $domain->status_id
                    ], $domain->id);
                    return [
                        'done' => true,
                        'domain' => $this->_prepareDomainData($domain)
                    ];
                }
            }

            return [
                'done' => false,
                'message' => DomainMessageCodeMap::DomainNotVerify
            ];
        } catch (\Exception $e) {
            return [
                'done' => false,
                'message' => DomainMessageCodeMap::DomainNotVerify
            ];
        }
    }

    /**
     * @param $domain
     * @return array
     */
    private function _prepareDomainData($domain)
    {
        return [
            'id' => $domain->id,
            'user_id' => $domain->user_id,
            'status_id' => $domain->status_id,
            'title' => $domain->title,
            'url' => $domain->url
        ];
    }

}