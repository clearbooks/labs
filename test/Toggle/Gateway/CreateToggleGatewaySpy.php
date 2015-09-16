<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:29
 */

namespace Clearbooks\Labs\Toggle\Gateway;


class CreateToggleGatewaySpy implements CreateToggleGateway
{
    /**
     * @var array
     */
    private $toggles;

    /**
     * @var int
     */
    private $toggleCount;

    /**
     * @param string $releaseId
     * @param string $toggleName
     * @param bool $visibility
     * @param string $toggleType
     * @return bool
     */
    public function addToggle( $releaseId, $toggleName, $visibility, $toggleType )
    {
        if ( $releaseId === "12" ) {
            return false;
        }
        $this->toggleCount++;
        $this->toggles[] = [ $this->toggleCount, $toggleName, $releaseId, $visibility, $toggleType ];

        return true;
    }
}