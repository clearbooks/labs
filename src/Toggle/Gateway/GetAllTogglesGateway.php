<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 11:45
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

interface GetAllTogglesGateway
{
    /**
     * @return MarketableToggle[]
     */
    public function getAllToggles();
}