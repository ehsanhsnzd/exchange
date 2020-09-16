<?php


namespace Src\Repository\Mysql;


class BuyRepository extends BaseRepository implements Repository
{

    public function allByCurrency($id)
    {
        $statement = "
          SELECT *
            FROM buys where currency_id= ? JOIN currencies ON buys.currency_id=currencies.id
            GROUP BY buys.id
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$id]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function all()
    {
        $statement = "
            SELECT *
            FROM buys JOIN currencies ON buys.currency_id=currencies.id
            GROUP BY buys.id
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function insert(array $input)
    {
        $statement = "
            INSERT INTO buys
                (amount, user_id, currency_id,fee,updated,created)
            VALUES
                (:amount, :user_id, :currency_id, :fee,:updated,:created);
        ";


        $statement = $this->db->prepare($statement);
        $result =$statement->execute(array(
            'amount' => $input['amount'],
            'user_id'  => $input['user_id'],
            'currency_id' => $input['currency_id'] ,
            'fee' => $input['fee'],
            'updated' => date('Y-m-d H:i:s'),
            'created' => date('Y-m-d H:i:s'),
        ));

        if (!$result)
            throw new \PDOException('error in inserting data');
        return $statement->rowCount();

    }

    public function update($id,array $input)
    {
        $statement = "
            UPDATE buys
            SET
                amount = :amount,
                confirm  = :confirm,
                updated = :updated
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' =>$id,
                'amount' => $input['amount'],
                'confirm'  => 1,
                'updated' => date('Y-m-d H:i:s'),
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM buys
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function get($id, $columns)
    {
        // TODO: Implement get() method.
    }
}