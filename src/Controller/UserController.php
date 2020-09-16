<?php
namespace Src\Controller;

use Src\Services\UserService;
use Src\Traits\ApiResponse;

class UserController extends BaseController {

    use ApiResponse;
    private $service;

    public function __construct()
    {
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
        try {
            $this->setMetaData($this->service->get($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
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
        try {
            $this->setMetaData($this->service->update($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $this->setMetaData($this->service->delete($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }


}
