<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:39
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Gateway\ActivatedToggleGateway;

class GetActivatedToggles
{
    /**
     * @var ActivatedToggleGateway
     */
    private $gateway;

    /**
     * GetActivatedToggles constructor.
     * @param ActivatedToggleGateway $gateway
     */
    public function __construct(ActivatedToggleGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param string $userIdentifier
     * @return ActivatableToggle[]
     */
    public function execute($userIdentifier)
    {
        return $this->gateway->getAllMyActivatedToggles($userIdentifier);
    }
}