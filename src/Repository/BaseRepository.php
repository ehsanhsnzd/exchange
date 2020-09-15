<?php


namespace Src\Repository;
use Src\Database\DatabaseConnector;


class BaseRepository
{

    protected $db;

    public function __construct()
    {
        $this->db = (new DatabaseConnector())->getConnection();

    }
}