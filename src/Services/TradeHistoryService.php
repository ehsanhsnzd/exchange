<?php


namespace Src\Services;


use Src\Repository\Mysql\TradeHistoryRepository;

class TradeHistoryService
{
    private $repository;
    private $user;

    public function __construct($user,$repository = NULL){
        $this->repository = $repository ?? new TradeHistoryRepository();
        $this->user =$user;
    }

    public function all()
    {
        return $this->repository->getByUser($this->user);
    }

}