<?php


namespace Src\Services;


use Src\Repository\Mysql\BuyRepository;

class BuyService
{

    /**
     * @var mixed|null
     */
    private $repository;

    public function __construct($repository = NULL){
        $this->repository = $repository ?? new BuyRepository();
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