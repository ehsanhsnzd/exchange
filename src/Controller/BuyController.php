<?php
namespace Src\Controller;

use Src\Services\BuyService;
use Src\Traits\ApiResponse;

class BuyController {

    use ApiResponse;
    private $service;

    public function __construct($user)
    {
        $this->service = new BuyService($user);
    }

    public function getAll($req)
    {
        try {
            $response = $this->service->all($req);
            return $this->setMetaData($response)->successResponse();
        }catch (\Exception $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }


    public function set()
    {
        try {
            $response = $this->service->insert();
            return $this->setMetaData($response)->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->service->delete($id);
            $this->setMetaData($response)->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }


}
