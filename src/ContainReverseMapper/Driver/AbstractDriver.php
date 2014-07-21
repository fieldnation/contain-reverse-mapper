<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 11:29 AM
 */

namespace ContainReverseMapper\Driver;


abstract class AbstractDriver implements DriverInterface {
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }



    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection->getConnection();
    }


} 