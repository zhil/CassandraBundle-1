<?php

namespace Mmd\Bundle\CassandraBundle\Service;

/**
 * @method \PDOStatement prepare
 */
class Cassandra
{
    protected $nodes        = '';
    protected $keyspace     = '';
    protected $connection   = NULL;

    public function __construct($nodes, $keyspace)
    {
        $this->nodes        = $nodes;
        $this->keyspace     = $keyspace;
        $this->connection   = new \PDO('cassandra:'. $nodes);

        $this->exec('USE '. $this->keyspace .';');
    }

    public function __call($method, $args)
    {
        $result = call_user_func_array(array($this->connection, $method), $args);

        if ($method === 'prepare') {
            $result = new PDOStatement($result);
        }

        $this->check_errors();

        return $result;
    }

    protected function check_errors()
    {
        $error = $this->connection->errorInfo();

        if ($error[1] !== null)
            throw new \Exception('Cassandra ['. $error[0] .':'. $error[1] .'] '. $error[2]);
    }
}

/**
 * @method execute
 */
class PDOStatement
{
    protected $stmt = null;

    public function __construct(\PDOStatement $stmt)
    {
        $this->stmt         = $stmt;
        $this->queryString  = $stmt->queryString;
    }

    public function __call($method, $args)
    {
        $result = call_user_func_array(array($this->stmt, $method), $args);

        $this->check_errors();

        return $result;
    }

    protected function check_errors()
    {
        $error = $this->stmt->errorInfo();

        if ($error[1] !== null)
            throw new \Exception('Cassandra ['. $error[0] .':'. $error[1] .'] '. $error[2]);
    }
}