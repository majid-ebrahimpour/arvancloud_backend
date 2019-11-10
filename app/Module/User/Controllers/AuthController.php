<?php

namespace App\Module\User\Controllers;

use App\Module\Application\Controllers\AbstractRestfulController;
use App\Module\User\Service\AuthService;
use App\Module\User\Service\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends AbstractRestfulController
{

    /**
     * @var AuthServiceInterface $authService
     */
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function signIn(Request $request)
    {
        $data = $this->getPostData($request);
        $results = $this->authService->signIn($data);
        return [
            'done' => true,
            'data' => $results,
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function signUp(Request $request)
    {
        $data = $this->getPostData($request);
        $results = $this->authService->signUp($data);
        return [
            'done' => true,
            'data' => $results,
        ];
    }

}
