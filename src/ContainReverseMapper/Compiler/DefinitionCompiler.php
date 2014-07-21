<?php

namespace ContainReverseMapper\Compiler;

class DefinitionCompiler {
    protected $entityProperties;
    protected $targetEntity;
    protected $targetNamespace;
    protected $entityDir;

    public function compile()
    {
        if (!$this->entityDir) {
            $this->entityDir = '__DIR__ . \'/..\'';
        }

        ob_start();
        include (__DIR__ . '/Templates/Definition/template.php');
        $compiled = ob_get_contents();
        ob_end_clean();

        return $compiled;
    }

    /**
     * @param array $entityProperties
     */
    public function setEntityProperties($entityProperties)
    {
        $this->entityProperties = $entityProperties;
    }

    /**
     * @param string $targetNamespace
     */
    public function setTargetNamespace($targetNamespace)
    {
        $this->targetNamespace = $targetNamespace;
    }

    /**
     * @param mixed $entityDir
     */
    public function setEntityDir($entityDir)
    {
        $this->entityDir = $entityDir;
    }

    /**
     * @param string $targetEntity
     */
    public function setTargetEntity($targetEntity)
    {
        $this->targetEntity = $targetEntity;
    }
}
