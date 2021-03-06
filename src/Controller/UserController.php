<?php
namespace Src\Controller;

use Src\Services\UserService;
use Src\Traits\ApiResponse;

class UserController extends BaseController {

    use ApiResponse;
    private $service;
    private $user;

    public function __construct($user = null)
    {
        $this->service = new UserService();
        $this->user = $user;
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

    public function balance($id)
    {
        try {
            $this->setMetaData($this->service->balance($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function get()
    {
        try {
            $this->setMetaData($this->service->get($this->user))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function register()
    {
        try {
            $response = $this->service->register();
            $this->setMetaData($response)->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function login()
    {
        try {
            $this->setMetaData($this->service->login())->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function update($id)
    {
        try {
            $this->setMetaData($this->service->update($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function delete($id)
    {
        try {
            $this->setMetaData($this->service->delete($id))->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }


}
