<?php

namespace App\Module\Application\Controllers;

use App\Http\Controllers\Controller;
use App\Module\User\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbstractRestfulController extends Controller
{

    const CONTENT_TYPE_JSON = 'json';

    /**
     * @var AbstractRestfulServiceInterface
     */
    protected $restfulService;

    /**
     * Create a new resource
     *
     * @param  Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $data = $this->getPostData($request);
        $userId = $this->getUserId($request);
        $result = $this->restfulService->create($data, $userId);
        return response(
            $result,
            200,
            []
        );
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Delete the entire resource collection
     *
     * @param  Request $request
     * @return mixed
     */
    public function deleteList(Request $request)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Return single resource
     *
     * @param  Request $request
     * @param  mixed $id
     * @return mixed
     */
    public function get(Request $request, $id)
    {
        $userId = $this->getUserId($request);
        $result = $this->restfulService->get($id, $userId);
        return response(
            $result,
            200,
            []
        );
    }

    /**
     * Return list of resources
     *
     * @param  Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $userId = $this->getUserId($request);
        $result = $this->restfulService->getList($userId);
        return response(
            $result,
            200,
            []
        );
    }

    /**
     * Retrieve HEAD metadata for the resource
     *
     * @param  null|mixed $id
     * @return mixed
     */
    public function head($id = null)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Respond to the OPTIONS method
     *
     * Typically, set the Allow header with allowed HTTP methods, and
     * return the response.
     *
     * @return mixed
     */
    public function options()
    {
        return response(
            'Method Allowed',
            200,
            []
        );
    }

    /**
     * Respond to the PATCH method
     *
     * @param  Request $request
     * @param  $id
     * @return array
     */
    public function patch(Request $request, $id)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Replace an entire resource collection
     *
     * @param  Request $request
     * @return mixed
     */
    public function replaceList(Request $request)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Modify a resource collection without completely replacing it
     *
     * @param  Request $request
     * @return mixed
     */
    public function patchList(Request $request)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    /**
     * Update an existing resource
     *
     * @param  Request $request
     * @param  mixed $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return response(
            'Method Not Allowed',
            405,
            []
        );
    }

    public function getUserId(Request $request, $params = [])
    {
        $accessToken = '';
        $header = $request->header('Authorization');
        if (Str::startsWith($header, 'Token ')) {
            $accessToken = Str::substr($header, 6);
        }

        if($accessToken != '') {
            $authService = new AuthService();
            $userId = $authService->getUserId($accessToken);
            if((int)$userId > 0) {
                return $userId;
            }
        }

        http_response_code(401);
        exit(json_encode([
            "done" => false,
            "status" => 401
        ]));
    }

    /**
     * Decode a JSON string.
     *
     * @param string
     * @return mixed
     */
    protected function jsonDecode($string)
    {
        if (function_exists('json_decode')) {
            return json_decode($string, true);
        }
        return false;
    }

    /**
     * Return data from post method request
     *
     * @param Request $request
     * @return array
     */
    protected function getPostData(Request $request)
    {
        $input = $request->all();
        $data = (isset($input['data'])) ? $this->_cleanInputs($input['data']) : null;
        return $data;
    }

    private function _cleanInputs($data)
    {
        $clean_input = [];
        if(is_array($data)){
            foreach($data as $k => $v){
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = is_bool($data) ? $data : filter_var(trim($data), FILTER_SANITIZE_STRING , FILTER_FLAG_NO_ENCODE_QUOTES);
        }
        return $clean_input;
    }

}
