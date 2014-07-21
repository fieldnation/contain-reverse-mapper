<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 11:51 AM
 */

namespace ContainReverseMapper\Driver\Pdo;

use ContainReverseMapper\Driver\ConnectionInterface;

class Connection implements ConnectionInterface {
    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getConnection()
    {
        return $this->db;
    }
} 