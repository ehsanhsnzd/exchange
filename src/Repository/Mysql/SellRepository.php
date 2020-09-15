<?php


namespace Src\Repository\Mysql;


class SellRepository extends BaseRepository implements Repository
{
    public function all()
    {
        $statement = "
            SELECT
                *
            FROM
                sells;
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
            INSERT INTO sells
                (amount, user_id, currency_id,updated,created)
            VALUES
                (:name, :amount, :user_id, :currency_id, :updated,:created);
        ";


        $statement = $this->db->prepare($statement);
        $result =$statement->execute(array(
            'name' => $input['name'],
            'email'  => $input['email'],
            'password' => md5($input['password']),
            'mobile' => $input['mobile'] ?? null,
            'updated' => date('Y-m-d H:i:s'),
            'created' => date('Y-m-d H:i:s'),
        ));

        if (!$result)
            throw new \PDOException('error in inserting data');
        return $statement->rowCount();

    }


    public function delete($id)
    {
        $statement = "
            DELETE FROM sells
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

    public function update($id, array $input)
    {
        // TODO: Implement update() method.
    }
}