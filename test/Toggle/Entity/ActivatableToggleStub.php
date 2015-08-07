<?php
namespace Clearbooks\Labs\Toggle\Entity;

/**
 * Class ActivatableToggleStub
 */
class ActivatableToggleStub implements ActivatableToggle
{
    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @param boolean $isActive
     */
    public function __construct( $isActive )
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function isActive()
    {
        return $this->isActive;
    }

}