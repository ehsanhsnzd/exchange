<?php
namespace Src\Repository;

class UserRepository extends BaseRepository {


    public function all()
    {
        $statement = "
            SELECT
                id, firstname, lastname, firstparent_id, secondparent_id
            FROM
                person;
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
            $statement->execute([$input['email'],$input['password']]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
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
                'password' => $input['password'],
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
            UPDATE person
            SET
                firstname = :firstname,
                lastname  = :lastname,
                firstparent_id = :firstparent_id,
                secondparent_id = :secondparent_id
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'firstparent_id' => $input['firstparent_id'] ?? null,
                'secondparent_id' => $input['secondparent_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM person
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