<?php
namespace Clearbooks\Labs\User\ToggleActivator;

class Request implements \Clearbooks\Labs\User\UseCase\ToggleActivator\Request
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @return string
     */
    public function getToggleIdentifier()
    {
        return $this->toggleIdentifier;
    }

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier )
    {
        $this->toggleIdentifier = $toggleIdentifier;
    }
}
//EOF Request.php
