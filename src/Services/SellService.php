<?php


namespace Src\Services;


use Src\Repository\Mysql\DepositRepository;
use Src\Repository\Mysql\SellRepository;

class SellService
{
    /**
     * @var mixed|null
     */
    private $repository;
    private $depositRepository;
    private $user;

    public function __construct($user,$repository = NULL){
        $this->repository = $repository ?? new SellRepository();
        $this->depositRepository = new DepositRepository();
        $this->user = $user;
    }

    public function insert()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $input['user_id'] = $this->user ;
        $balance = $this->depositRepository->balance($this->user ,$input['currency_id']);
        if ($balance['user_balance']< $input['amount'])
            throw new \Exception('Dont have enough balance');

        $result = $this->repository->insert($input);

        (new TradeService())->doTrade($input['from'],$input['to']);

        return $result;
    }


    public function all($req)
    {
        return $this->repository->allByCurrency($req['to']);
    }

    public function update($id,Array $input)
    {
        return $this->repository->update($id,$input);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}