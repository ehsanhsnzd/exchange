<?php


namespace Src\Repository\Mysql;


class TradeHistoryRepository extends BaseRepository implements Repository
{

    public function getByUser($userId)
    {
        $statement = "
            SELECT buy_fee,sell_fee,amount,created,t1.currency as buy_currency,t2.currency as sell_currency
            FROM trade_history
                       JOIN   currencies t1   ON trade_history.buy_currency_id=t1.id
                       JOIN   currencies t2  ON trade_history.sell_currency_id=t2.id
            GROUP BY trade_history.id
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$userId]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function get($id, $columns)
    {
        // TODO: Implement get() method.
    }

    public function insert(array $input)
    {
        $statement = "
            INSERT INTO trade_history
                (amount, user_id, buy_currency_id,sell_currency_id,buy_fee,sell_fee,updated,created)
            VALUES
                (:amount, :user_id, :buy_currency_id, :sell_currency_id, :buy_fee, :sell_fee,:updated,:created);
        ";


        $statement = $this->db->prepare($statement);
        $result =$statement->execute(array(
            'amount' => $input['amount'],
            'user_id'  => $input['user_id'],
            'buy_currency_id' => $input['buy_currency_id'] ,
            'sell_currency_id' => $input['sell_currency_id'] ,
            'buy_fee' => $input['buy_fee'],
            'sell_fee' => $input['sell_fee'],
            'updated' => date('Y-m-d H:i:s'),
            'created' => date('Y-m-d H:i:s'),
        ));

        if (!$result)
            throw new \PDOException('error in inserting data');
        return $statement->rowCount();

    }

    public function update($id, array $input)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }
}