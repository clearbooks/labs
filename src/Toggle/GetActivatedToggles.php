<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:39
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGateway;

class GetActivatedToggles implements UseCase\GetActivatedToggles
{
    /**
     * @var GetAllTogglesGateway
     */
    private $gateway;

    /**
     * GetActivatedToggles constructor.
     * @param GetAllTogglesGateway $gateway
     */
    public function __construct( GetAllTogglesGateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param string $userIdentifier
     * @return ActivatableToggle[]
     */
    public function execute( $userIdentifier )
    {
        return $this->gateway->getAllToggles();
    }
}