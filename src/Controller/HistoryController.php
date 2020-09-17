<?php
namespace Src\Controller;

use Src\Services\BuyService;
use Src\Services\TradeHistoryService;
use Src\Traits\ApiResponse;

class HistoryController {

    use ApiResponse;
    private $service;

    public function __construct($user)
    {
        $this->service = new TradeHistoryService($user);
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




}
