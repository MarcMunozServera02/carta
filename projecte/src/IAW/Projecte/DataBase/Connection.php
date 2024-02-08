<?php declare( strict_types=1 );

namespace IAW\Projecte\DataBase;

use PDO;

class Connection
{
    private ?PDO $db = null;
    
    public function __construct()
    {
        $this->connect();
    }
    
    public function connect(): self
    {
        if ( is_null( $this->db ) ) {
            $this->db = new PDO("mysql:host=localhost;dbname=IAW","root","1234");    
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        
        return $this;
    }
    
    public function get(): PDO
    {
        return $this->db;
    }
}