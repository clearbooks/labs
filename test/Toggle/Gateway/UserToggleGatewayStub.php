<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 04/08/2015
 * Time: 15:43
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\UserToggle;

class UserToggleGatewayStub implements UserToggleGateway
{

    /**
     * @var
     */
    private $userToggles;

    public function __construct( $userToggles )
    {

        $this->userToggles = $userToggles;
    }

    /**
     * @return UserToggle[]
     */
    public function getAllUserToggles()
    {
        return $this->userToggles;
    }
}