<?php
namespace Src\Controller;

use Src\Services\BuyService;
use Src\Traits\ApiResponse;

class BuyController {

    use ApiResponse;
    private $service;

    public function __construct()
    {
        $this->service = new BuyService();
    }

    public function getAll()
    {
        try {
            $response = $this->service->all();
            return $this->setMetaData($response)->successResponse();
        }catch (\Exception $exception){
            $this->customResponse($exception->getMessage(),$exception->getCode(),$exception->getCode());
        }
    }


    public function setBuy()
    {
        try {
            $response = $this->service->insert();
            $this->setMetaData($response)->successResponse();
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
