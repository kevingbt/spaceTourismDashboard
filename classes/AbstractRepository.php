<?php

abstract class AbstractRepository
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host={$_ENV['db_host']};dbname={$_ENV['db_name']};port={$_ENV['db_port']}", $_ENV['db_user'], $_ENV['db_password']);
    }
}
