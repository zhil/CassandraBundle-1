<?php

namespace Mmd\CassandraBundle\Service;

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

    public function exec($cql)
    {
        $result = $this->connection->exec($cql);

        $this->check_errors();

        return $result;
    }

    public function prepare($cql)
    {
        $result = $this->connection->prepare($cql);

        $this->check_errors();

        return $result;
    }

    public function check_errors() {
        $error = $this->connection->errorInfo();

        if ($error[1])
            throw new \Exception( 'Cassandra ['. $error[0] .':'. $error[1] .'] '. $error[2] );
    }
}