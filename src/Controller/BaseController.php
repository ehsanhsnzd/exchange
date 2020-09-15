<?php


namespace Src\Controller;


use Src\Traits\ApiResponse;

class BaseController
{
    use ApiResponse;
    protected $method;
    protected $id;

    public function __construct($method, $id)
    {
        $this->method = $method;
        $this->id = $id;
    }

    public function processRequest()
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

        if ($uri[1] !== 'user') {
            if ($uri[2] !== 'login')
                $response = $this->login();

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
            if ($response) {
                return $response;
//            echo $response['body'];
            }
    }

}