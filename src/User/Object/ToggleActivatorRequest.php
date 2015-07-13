<?php
namespace User\Object;

class ToggleActivatorRequest
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
//EOF ToggleActivatorRequest.php
