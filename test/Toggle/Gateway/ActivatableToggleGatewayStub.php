<?php
namespace Clearbooks\Labs\Toggle\Gateway;
use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;
use Clearbooks\Labs\Toggle\Entity\ActivatableToggleStub;

/**
 * Class ActivatableToggleGatewayStub
 */
class ActivatableToggleGatewayStub implements ActivatableToggleGateway
{
    /**
     * @var boolean[]
     */
    private $toggleAvailabilityToggles;

    /**
     * @param boolean[] $toggleAvailabilityToggles toggle name => availability
     */
    public function __construct( $toggleAvailabilityToggles )
    {
        $this->toggleAvailabilityToggles = $toggleAvailabilityToggles;
    }

    /**
     * @param string $name The name of the toggle you seek
     * @return ActivatableToggle[]
     */
    public function getActivatableToggleByName( $name )
    {
        return new ActivatableToggleStub( $this->toggleAvailabilityToggles[$name] );
    }
}