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

    public function __construct($repository = NULL){
        $this->repository = $repository ?? new SellRepository();
        $this->depositRepository = $repository ?? new DepositRepository();
    }

    public function insert()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $balance = $this->depositRepository->balance(88,1);
        if ($balance< $input['amount'])
            throw new \Exception('Dont have enough balance');

        return $this->repository->insert($input);
    }

    public function all()
    {
        return $this->repository->all();
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