<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:39
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;
use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGateway;

class GetActivatedToggles implements UseCase\GetActivatedToggles
{
    /**
     * @var GetAllTogglesGateway
     */
    private $gateway;
    /**
     * @var ToggleChecker
     */
    private $toggleChecker;

    /**
     * GetActivatedToggles constructor.
     * @param GetAllTogglesGateway $gateway
     * @param ToggleChecker $toggleChecker
     */
    public function __construct( GetAllTogglesGateway $gateway, ToggleChecker $toggleChecker )
    {
        $this->gateway = $gateway;
        $this->toggleChecker = $toggleChecker;
    }

    /**
     * @param User $user
     * @param Group $group
     * @return MarketableToggle[]
     */
    public function execute( User $user, Group $group )
    {
        $activatedToggles = [ ];
        $toggles = $this->gateway->getAllToggles();
        foreach ( $toggles as $toggle ) {
            if ( $this->toggleChecker->isToggleActive( $toggle->getName(), $user, $group ) ) {
                $activatedToggles[] = $toggle;
            }
        }

        return $activatedToggles;
    }
}