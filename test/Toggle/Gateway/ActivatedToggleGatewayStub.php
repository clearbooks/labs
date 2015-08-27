<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:31
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;

class ActivatedToggleGatewayStub implements ActivatedToggleGateway
{
    /**
     * @var array
     */
    private $expectedToggles;

    /**
     * ActivatedToggleGatewayStub constructor.
     * @param array $expectedToggles
     */
    public function __construct($expectedToggles)
    {
        $this->expectedToggles = $expectedToggles;
    }

    /**
     * @return ActivatableToggle[]
     */
    public function getAllMyActivatedToggles($user_identifier)
    {
        return $this->expectedToggles;
    }
}