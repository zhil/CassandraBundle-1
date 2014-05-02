CassandraBundle
===============

[Apache Cassandra PDO](https://github.com/Orange-OpenSource/YACassandraPDO)

## Installation

* Include in `AppKernel.php`

  ```php
  new Mmd\Bundle\CassandraBundle\MmdCassandraBundle(),
  ```

* Configure parameters in `app/config/parameters.yml`

  ```yml
  parameters:
      #...

      mmd.cassandra.nodes: host=localhost;port=9160
      mmd.cassandra.keyspace: my_keyspace
  ```

## Usage

```php
/**
 * @var \Mmd\Bundle\CassandraBundle\Service\CassandraPDO $cassandra
 */
$cassandra = $this->get('mmd.cassandra_pdo');

$stmt = $cassandra->prepare("SELECT id FROM my_table WHERE id = :id LIMIT 1;");
$stmt->bindValue(':id', $id);
$stmt->execute();

$row = $stmt->fetchObject();
```
