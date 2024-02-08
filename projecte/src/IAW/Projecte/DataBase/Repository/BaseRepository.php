<?php declare( strict_types=1 );

namespace IAW\Projecte\DataBase\Repository;

use IAW\Projecte\Container;
use IAW\Projecte\DataBase\Connection;
use PDO;

class BaseRepository
{
    protected ?Connection $connection;

    public function __construct()
    {
        $this->connection = Container::service()->getConnection();
    }

   
}