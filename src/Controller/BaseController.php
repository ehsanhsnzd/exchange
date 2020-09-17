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

    public function __construct($method)
    {
        $this->method = $method;
    }

    public function processRequest()
    {
        try{
            $response = $this->handleRoute();
        } catch (\Exception $e) {
            $this->customResponse($e->getMessage(),$e->getCode(),200);
            die();
        }

            if ($response)
                return $response;

    }


    public function handleRoute()
    {
        $req = [];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        // the user id is, of course, optional and must be a number:
        $userId = null;
        if (isset($uri[2])) {
            $userId = (int)$uri[2];
        }

        // the user id is, of course, optional and must be a number:
        $userId = null;


        if ($uri[1] === 'user') {
            $this->controller = new UserController();
            if ($uri[2] === 'login' && $this->method == 'POST')
                return $response = $this->controller->login();

            if ($uri[2] === 'register' && $this->method == 'POST')
                return $response = $this->controller->register();
        }

        $user = $this->authenticate();
        $this->controller = new UserController($user);

        if ($uri[1] === 'user') {
            if ($uri[2] === 'balance')
                return $response = $this->controller->balance($user);

            switch ($this->method) {
                case 'GET':
                        return $response = $this->controller->get();
                    break;
                case 'PUT':
                    return $response = $this->controller->update($user);
                    break;
                case 'DELETE':
                    return $response = $this->controller->delete($user);
                    break;
            }
        }

        if (isset($uri[2]) && isset($uri[3]))
            $req['from'] = (int)$uri[2];
            $req['to'] = (int)$uri[3];

        if ($uri[1] === 'buy') {
            $this->controller = new BuyController($user);
            switch ($this->method) {
                case 'GET':
                    return $response = $this->controller->getAll($req);
                case 'POST':
                    return $response = $this->controller->set();
                    break;
            }
        }

        if ($uri[1] === 'sell') {
            $this->controller = new SellController($user);
            switch ($this->method) {
                case 'GET':
                    return  $response = $this->controller->getAll($req);
                case 'POST':
                    return $response = $this->controller->set();
                    break;
            }
        }

        if ($uri[1] === 'history') {
            if (isset($uri[2]))
                $id = (int)$uri[2];

            $this->controller = new HistoryController($user);
            switch ($this->method) {
                case 'GET':
                    return $response = $this->controller->getAll();
                    break;
            }
        }

    }

    public function authenticate()
    {

        switch (true) {
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

        if (!isset($authHeader)) {
            throw new \Exception('No Token Defined');
        }
        $user =  (new UserService())->validateToken($authHeader);
        if (!$user) {
            header("HTTP/1.1 401 Unauthorized");
            throw new \Exception('Not Valid Token');
        }

        return $user;

    }

}