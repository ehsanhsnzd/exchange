<?php


namespace Src\Repository\Mysql;


class DepositRepository extends BaseRepository implements Repository
{

    public function balance($userId,$currencyId = null)
    {
        $currencyId ?
        $statement = "
            select sum(balance) as user_balance from deposits where user_id = ? and  currency_id =? group by currency_id
        " :
            $statement = "
            select currency,sum(balance) as user_balance,currency_id from deposits JOIN currencies ON deposits.currency_id=currencies.id where user_id = ?  group by currency_id
        "
        ;

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute( $currencyId ? [$userId,$currencyId] : [$userId]);
            $result = $currencyId ? $statement->fetch(\PDO::FETCH_ASSOC) : $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function all()
    {
        // TODO: Implement all() method.
    }

    public function get($id, $columns)
    {
        // TODO: Implement get() method.
    }

    public function insert(array $input)
    {
        $statement = "
            INSERT INTO deposits
                (balance, currency_id,user_id,updated,created)
            VALUES
                (:balance, :currency_id,:user_id, :updated ,:created);
        ";


        $statement = $this->db->prepare($statement);
        $result =$statement->execute(array(
            'balance' => $input['balance'],
            'user_id' => $input['user_id'],
            'currency_id'  => $input['currency_id'],
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
}