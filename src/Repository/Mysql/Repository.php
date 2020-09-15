<?php


namespace Src\Repository\Mysql;


interface Repository
{

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @param $columns
     * @return mixed
     */
    public function get($id,$columns);

    /**
     * @param array $input
     * @return mixed
     */
    public function insert(array $input);

    /**
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id,array $input);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

}