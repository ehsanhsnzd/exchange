<?php
namespace Src\Controller;

use Src\Services\BuyService;
use Src\Services\SellService;
use Src\Traits\ApiResponse;

class SellController {

    use ApiResponse;
    private $service;

    public function __construct($user)
    {
        $this->service = new SellService($user);
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
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->service->delete($id);
            $this->setMetaData($response)->successResponse();
        }catch (\PDOException $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),500);
        }catch (\Exception $exception) {
            $this->customResponse($exception->getMessage(),$exception->getCode(),400);
        }
    }


}
