<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 2:50 PM
 */

namespace ContainReverseMapper\Driver\Pdo;

use ContainReverseMapper\Driver\MappingInterface;

class Mapping implements MappingInterface {
    public static function underscoreToCamelCase($val, $lowerCaseFirst = true)
    {
        $val = str_replace(' ','', ucwords(str_replace(array('_','-'), ' ',$val)));
        if ($lowerCaseFirst) {
            $val[0] = strtolower($val[0]);
        }

        return $val;
    }

    public static function getPropertyMap($prop) {
        $type = null;

        $t = $prop['DATA_TYPE'];
        if (preg_match('/^(float|decimal|double)$/',$t, $m)) {
            $type = 'double';
        } else if (preg_match('/^(tiny|small|medium|big)?int$/',$t,$m)) {
            $type = 'integer';
        } else if (preg_match('/^(varchar|char|text|tinytext|mediumtext|longtext|tinyblob|blob|mediumblob|longblob)$/',$t,$m)) {
            $type = 'string';
        } else if (preg_match('/^(date)$/',$t,$m)) {
            $type = 'date';
        } else if (preg_match('/^(datetime)$/',$t,$m)) {
            $type = 'datetime';
        } else if (preg_match('/^(time|timestamp)/',$t,$m)) {
            $type = 'double';
        }

        $colName = self::underscoreToCamelCase($prop['COLUMN_NAME']);

        $options = array();

        if ($prop['IS_NULLABLE'] == 'NO' && $prop['COLUMN_DEFAULT'] === null) {
            $options['required'] = 'true';
        }

        if ($prop['COLUMN_KEY'] == 'PRI') {
            $options['primary'] = 'true';
        }

        if ($prop['COLUMN_DEFAULT'] !== null) {
            $options['defaultValue'] = '\'' . $prop['COLUMN_DEFAULT'] . '\'';
        } else if ($prop['IS_NULLABLE'] == 'YES') {
            $options['defaultValue'] = 'null';
        }


        return array(
            $colName,
            $type,
            $options
        );
    }
} 