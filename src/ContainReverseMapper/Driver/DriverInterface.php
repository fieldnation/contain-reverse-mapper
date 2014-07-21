<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 11:35 AM
 */

namespace ContainReverseMapper\Driver;

interface DriverInterface {
    public function setSource($source);
    public function getEntityProperties();

}