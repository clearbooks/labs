<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Gateway\ActivatableToggleGateway;

class IsToggleActive implements UseCase\IsToggleActive
{
    /**
     * @var ActivatableToggleGateway
     */
    private $gateway;

    /**
     * @param ActivatableToggleGateway $gateway
     */
    public function __construct( ActivatableToggleGateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param string $toggleName
     * @return bool is it active
     */
    public function isToggleActive( $toggleName )
    {
        $toggle = $this->gateway->getActivatableToggleByName( $toggleName );
        return $toggle && $toggle->isActive() ?: false;
    }
}