<?php
namespace Src\Controller;

use Src\Services\UserService;
use Src\Traits\ApiResponse;

class UserController extends BaseController {

    use ApiResponse;
    private $service;

    public function __construct($method, $id)
    {
        parent::__construct($method,$id);
        $this->service = new UserService();
    }

    public function getAll()
    {
        try {
            $response = $this->service->all();
            $this->setMetaData($response)->successResponse();
        }catch (\Exception $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }

    public function get($id)
    {
        $result = $this->service->get($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function register()
    {
        try {
            $response = $this->service->register();
            $this->setMetaData($response)->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }

    public function login()
    {
        try {
            $this->setMetaData($this->service->login())->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }

    public function update($id)
    {
        $result = $this->service->get($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->service->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function delete($id)
    {
        $result = $this->personGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->personGateway->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }


}
