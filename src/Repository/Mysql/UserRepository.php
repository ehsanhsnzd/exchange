<?php
namespace Src\Repository\Mysql;

class UserRepository extends BaseRepository implements Repository {


    public function all()
    {
        $statement = "
            SELECT
                *
            FROM
                users;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function get($id,$columns)
    {
        $statement = "
            SELECT
                *
            FROM
                users
            WHERE $columns = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$id]);
            $result = $statement->rowCount();
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function login($input)
    {
        $statement = "
            SELECT
                id
            FROM
                users
            WHERE email = ? and password = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$input['email'],md5($input['password'])]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO users
                (name, email, password, mobile,updated,created)
            VALUES
                (:name, :email, :password, :mobile, :updated,:created);
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

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE users
            SET
                name = :name,
                email  = :email,
                password = :password,
                mobile = :mobile,
                updated = :updated
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'name' => $input['name'],
                'email'  => $input['email'],
                'password' => md5($input['password']),
                'mobile' => $input['mobile'] ?? null,
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
            DELETE FROM users
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
}