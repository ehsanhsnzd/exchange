<?php


namespace Src\Repository\Mysql;


class TradeHistoryRepository extends BaseRepository implements Repository
{

    public function getByUser($userId)
    {
        $statement = "
            SELECT
                *
            FROM
                trade_history
            where user_id = ?  limit 15  ;
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