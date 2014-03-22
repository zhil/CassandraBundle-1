CassandraBundle
===============

Apache Cassandra PDO

## Installation

Include in `AppKernel.php`

```php
new Mmd\Bundle\CassandraBundle\MmdCassandraBundle(),
```

## Usage

```php
/**
 * @var \Mmd\Bundle\CassandraBundle\Service\Cassandra $cassandra
 */
$cassandra = $this->get('mmd.cassandra');
```
