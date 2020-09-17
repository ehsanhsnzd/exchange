<?php


namespace Src\Services;


use Src\queue\WorkerSender;
use Src\Repository\Mysql\BuyRepository;
use Src\Repository\Mysql\DepositRepository;

class BuyService
{

    /**
     * @var mixed|null
     */
    private $repository;
    private $depositRepository;
    private $user;

    public function __construct($user,$repository = NULL){
        $this->repository = $repository ?? new BuyRepository();
        $this->depositRepository = new DepositRepository();
        $this->user =$user;
    }

    public function all($req)
    {
        return $this->repository->allByCurrency($req['from']);
    }

    public function insert()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $input['user_id'] = $this->user ;
        $balance = $this->depositRepository->balance($this->user ,$input['currency_id']);
        if ($balance['user_balance']< ($input['amount']*$input['fee']))
            throw new \Exception('Dont have enough balance');

         $result = $this->repository->insert($input);


//        (new TradeService())->doTrade($input['from'],$input['to']);
        $sender = new WorkerSender();
        $sender->execute(json_encode([$input['from'],$input['to']]));

        return $result;
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