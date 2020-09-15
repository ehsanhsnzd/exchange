<?php


namespace Src\Controller;


use Src\Services\UserService;
use Src\Traits\ApiResponse;

class BaseController
{
    use ApiResponse;
    protected $method;
    protected $id;
    /**
     * @var BuyController
     */
    private $controller;

    public function __construct($method, $id)
    {
        $this->method = $method;
        $this->id = $id;
    }

    public function processRequest()
    {

            $response = $this->handleRoute();

            if ($response) {
                return $response;
            }

    }


    public function handleRoute()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        // the user id is, of course, optional and must be a number:
        $userId = null;
        if (isset($uri[2])) {
            $userId = (int) $uri[2];
        }

        // the user id is, of course, optional and must be a number:
        $userId = null;
        if (isset($uri[2])) {
            $userId = (int) $uri[2];
        }

        if ($uri[1] === 'user')
            if ($uri[2] === 'login')
                return $response = $this->login();

        if ($uri[1] === 'user') {
            $this->authenticate();
            switch ($this->method) {
                case 'GET':
                    if ($this->id) {
                        $response = $this->get($this->id);
                    } else {
                        $response = $this->getAll();
                    };
                    break;
                case 'POST':
                    $response = $this->register();
                    break;
                case 'PUT':
                    $response = $this->update($this->id);
                    break;
                case 'DELETE':
                    $response = $this->delete($this->id);
                    break;
                default:
                    $response = $this->notFoundResponse();
                    break;
            }
        }

        if ($uri[1] === 'buy') {
            $this->controller = new BuyController();
            return $response = $this->controller->getAll();
        }


        if ($uri[1] === 'sell') {
            return $response = $this->getAll();
        }

    }

    function authenticate() {
        try {
            switch(true) {
                case array_key_exists('HTTP_AUTHORIZATION', $_SERVER) :
                    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
                    break;
                case array_key_exists('Authorization', $_SERVER) :
                    $authHeader = $_SERVER['Authorization'];
                    break;
                default :
                    $authHeader = null;
                    break;
            }

            if(!isset($authHeader)) {
                throw new \Exception('No Token Defined');
            }

            if(!(new UserService())->validateToken($authHeader)) {
                header("HTTP/1.1 401 Unauthorized");
                throw new \Exception('Not Valid Token');
            }

            return true;
        } catch (\Exception $e) {
            $this->customResponse($e->getMessage(),$e->getCode(),$e->getCode());
            die();
        }
    }


}