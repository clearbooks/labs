<?php
namespace User\Object;

class ToggleActivatorResponse
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int|null
     */
    private $error = null;

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

    /**
     * @return int|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int|null $error
     */
    public function setError( $error )
    {
        $this->error = $error;
    }
}
//EOF ToggleActivatorResponse.php
