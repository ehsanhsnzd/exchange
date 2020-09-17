<?php


namespace Src\Repository\Mysql;


class TradeRepository extends BaseRepository implements Repository
{

    public function trade($from,$to)
    {
        $statement = "
select * from
(select amount as buy_amount, id as buy_id ,fee as buy_fee,user_id as buy_user,currency_id as buy_currency
from buys where currency_id = ?
order by buy_fee desc limit 1) t1
 join
(select amount as sell_amount, id as sell_id ,fee as sell_fee,user_id as sell_user,currency_id as sell_currency
from sells where currency_id = ?
order by sell_fee asc  limit 1) t2



        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$from,$to]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
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
        // TODO: Implement insert() method.
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