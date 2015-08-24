<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 11:51
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;

class ActivatedToggleGatewayDummy implements ActivatedToggleGateway
{

    /**
     * @return ActivatableToggle[]
     */
    public function getAllMyActivatedToggles($user_identifier)
    {
        return [];
    }
}