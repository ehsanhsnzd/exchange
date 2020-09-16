<?php


namespace Src\Services;


use Src\Repository\Mysql\BuyRepository;
use Src\Repository\Mysql\DepositRepository;
use Src\Repository\Mysql\SellRepository;
use Src\Repository\Mysql\TradeHistoryRepository;
use Src\Repository\Mysql\TradeRepository;

class TradeService
{
    /**
     * @var TradeRepository
     */
    private $repository;

    private $buyRepository;
    private $sellRepository;
    private $depositRepository;
    private $historyRepository;

    public function __construct($repository =null)
    {
        $this->repository = $repository ?? new TradeRepository();
        $this->buyRepository = new BuyRepository();
        $this->sellRepository = new SellRepository();
        $this->depositRepository = new DepositRepository();
        $this->historyRepository = new TradeHistoryRepository();
    }

    public function doTrade($from,$to)
    {
        $trades = $this->repository->trade(1,2);

        if(is_array($trades))
        if($trades['buy_fee'] == $trades['sell_fee']) {
            $this->calc($trades);
        }else if($trades['buy_fee'] > $trades['sell_fee']) {
            $this->calc($trades);
            $this->doTrade();
        }
    }

    public function calc(array $trades)
    {
        if ($trades['buy_amount'] == $trades['sell_amount']) {
            $this->buyRepository->delete($trades['buy_id']);
            $this->sellRepository->delete($trades['sell_id']);
        }
        else if ($trades['buy_amount'] > $trades['sell_amount']) {
            $trades['buy_amount'] = $trades['buy_amount'] - $trades['sell_amount'];

            $this->sellRepository->delete($trades['sell_id']);
            $this->buyRepository->update($trades['buy_id'], ['amount' => ($trades['buy_amount'])]);
            $trades['buy_amount'] =  $trades['sell_amount'];

        }
        else if ($trades['buy_amount'] < $trades['sell_amount']) {
            $trades['sell_amount'] = $trades['sell_amount'] - $trades['buy_amount'];

            $this->buyRepository->delete($trades['buy_id']);
            $this->sellRepository->update($trades['buy_id'], ['amount' => ($trades['sell_amount'] )]);
            $trades['sell_amount'] = $trades['buy_amount'];
        }

        $this->balance($trades);

        $this->tradeHistory($trades,$trades['buy_user']);
        $this->tradeHistory($trades,$trades['sell_user']);

    }

    public function tradeHistory($trades,$user)
    {
        return $this->historyRepository->insert([
            'user_id' => $user,
            'buy_currency_id'=>$trades['buy_currency'],
            'sell_currency_id'=>$trades['sell_currency'],
            'buy_fee'=>$trades['buy_fee'],
            'sell_fee'=>$trades['sell_fee'],
            'amount'=>$trades['buy_amount'],
        ]);
    }

    public function balance($trades){
        $deductBuyBalance = -($trades['buy_amount']*$trades['buy_fee']);//buy_currency
        $buyBalance = $trades['buy_amount']; //sell_currency
        $this->depositRepository->insert([
            'balance' => $deductBuyBalance,
            'currency_id' => $trades['buy_currency'],
            'user_id' =>$trades['buy_user']
        ]);
        $this->depositRepository->insert([
            'balance' => $buyBalance,
            'currency_id' => $trades['sell_currency'],
            'user_id' =>$trades['buy_user']
        ]);


        $deductSellBalance = -($trades['sell_amount']);//sell_currency
        $sellBalance =$trades['sell_amount']*$trades['sell_fee'];//buy_currency
        $this->depositRepository->insert([
            'balance' => $deductSellBalance,
            'currency_id' => $trades['sell_currency'],
            'user_id' =>$trades['sell_user']
        ]);
        $this->depositRepository->insert([
            'balance' => $sellBalance,
            'currency_id' => $trades['buy_currency'],
            'user_id' =>$trades['sell_user']
        ]);
    }

}