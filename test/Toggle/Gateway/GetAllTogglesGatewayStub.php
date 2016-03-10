<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:31
 */

namespace Clearbooks\Labs\Toggle\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class GetAllTogglesGatewayStub implements GetAllTogglesGateway
{
    /**
     * @var MarketableToggle[]
     */
    private $expectedToggles;

    /**
     * ActivatedToggleGatewayStub constructor.
     * @param MarketableToggle[] $expectedToggles
     */
    public function __construct( $expectedToggles = [ ] )
    {
        $this->expectedToggles = $expectedToggles;
    }

    /**
     * @return MarketableToggle[]
     */
    public function getAllToggles()
    {
        return $this->expectedToggles;
    }

    /**
     * @param MarketableToggle[] $expectedToggles
     */
    public function setExpectedToggles( $expectedToggles )
    {
        $this->expectedToggles = $expectedToggles;
    }
}
