<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 11:34 AM
 */

namespace ContainReverseMapper\Driver\Pdo;
use ContainReverseMapper\Driver\AbstractDriver;

class Driver extends AbstractDriver {
    protected $tableName;

    public function setSource($source) {
        $this->tableName = $source;
    }

    public function getEntityProperties() {
        $columns = $this->getTableColumns();

        $properties = array();
        foreach ($columns as $column) {
            $properties[] = Mapping::getPropertyMap($column);
        }

        return $properties;
    }

    protected function getTableColumns()
    {

        $db = $this->getConnection();

        $dbNameStmt = $db->query('SELECT DATABASE()');
        $dbName = $dbNameStmt->fetchColumn();

        $stmt = $db->prepare('
            SELECT * FROM information_schema.columns
            WHERE table_name=:tbl
              AND table_schema=:db
              ORDER BY ordinal_position ASC
        ');
        $stmt->bindParam(':tbl', $this->tableName);
        $stmt->bindParam(':db', $dbName);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

}