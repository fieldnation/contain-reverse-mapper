<?php echo '<?php'; ?>

namespace <?php echo $this->targetNamespace; ?>;


use Contain\Entity\Definition\AbstractDefinition;

class <?php echo $this->targetEntity ?> extends AbstractDefinition {
    public function setUp()
    {
        $this->setNamespace('<?php
            $nsPieces = explode('\\',$this->targetNamespace);
            array_pop($nsPieces);
            echo implode('\\', $nsPieces);
        ?>');

        $this->registerTarget(AbstractDefinition::ENTITY, <?php echo $this->entityDir ?>);

<?php foreach ($this->entityProperties as $property): ?>
        $this->setProperty('<?php echo $property[0] ?>', '<?php echo $property[1] ?>'<?php if (isset($property[2]) && count($property[2]) > 0): ?>, array(
<?php foreach ($property[2] as $option => $val): ?>            '<?php echo $option ?>' => <?php echo $val ?>,
<?php endforeach; ?>
        )<?php endif; ?>);

<?php endforeach; ?>
    }
}