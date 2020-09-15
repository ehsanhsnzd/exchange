<?php


namespace Src\Repository\Mysql;
use Src\Database\DatabaseConnector;


class BaseRepository
{

    protected $db;

    public function __construct()
    {
        $this->db = (new DatabaseConnector())->getConnection();

    }
}