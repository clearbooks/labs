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
     * @var string[]
     */
    private $existentReleaseIds;

    /**
     * CreateToggleGatewaySpy constructor.
     * @param string[] $existentReleaseIds
     */
    public function __construct( $existentReleaseIds )
    {
        $this->existentReleaseIds = $existentReleaseIds;
    }

    /**
     * @param string $releaseId
     * @param string $toggleName
     * @param bool $visibility
     * @param string $toggleType
     * @return string
     */
    public function addToggle( $releaseId, $toggleName, $visibility, $toggleType )
    {
        if ( !in_array( $releaseId, $this->existentReleaseIds ) ) {
            return "";
        }
        $this->toggleCount++;
        $this->toggles[] = [ $this->toggleCount, $toggleName, $releaseId, $visibility, $toggleType ];

        return "1";
    }
}