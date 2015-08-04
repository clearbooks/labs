<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 04/08/2015
 * Time: 12:58
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\UserToggle;

interface UserToggleGateway
{
    /**
     * @return UserToggle[]
     */
    public function getAllUserToggles();
}