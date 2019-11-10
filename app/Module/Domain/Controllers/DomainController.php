<?php

namespace App\Module\Domain\Controllers;

use Illuminate\Http\Request;
use App\Module\Application\Controllers\AbstractRestfulController;
use App\Module\Domain\Service\DomainService;

class DomainController extends AbstractRestfulController
{

    public function __construct()
    {
        $this->restfulService = new DomainService();
    }

    public function verify(Request $request, $domainId)
    {
        $userId = $this->getUserId($request);
        $result = $this->restfulService->verfify($domainId, $userId);
        return response(
            $result,
            200,
            []
        );
    }

}
