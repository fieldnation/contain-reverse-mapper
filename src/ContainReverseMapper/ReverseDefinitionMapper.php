<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 5/20/14
 * Time: 11:27 AM
 */

namespace ContainReverseMapper;

use Contain\Entity\Definition\AbstractDefinition;
use ContainReverseMapper\Driver\AbstractDriver;
use ContainReverseMapper\Compiler\DefinitionCompiler;


class ReverseDefinitionMapper {
    protected $sourceEntity;
    protected $targetEntity;
    protected $driver;


    public function __construct($sourceEntity, $targetEntity, AbstractDriver $driver) {
        $this->sourceEntity = $sourceEntity;
        $this->targetEntity = $targetEntity;
        $this->driver = $driver;
        $this->driver->setSource($sourceEntity);
    }


    public function export($fileName, $namespace = null, $entityDir = null)
    {
        $props = $this->driver->getEntityProperties();
        $compiler = new DefinitionCompiler();
        $compiler->setEntityProperties($props);
        $compiler->setTargetEntity($this->targetEntity);
        $compiler->setTargetNamespace($namespace);
        $compiler->setEntityDir($entityDir);


        $code = $compiler->compile();

        file_put_contents($fileName, $code);
    }
}