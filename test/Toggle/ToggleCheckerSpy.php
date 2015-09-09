<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 09/09/2015
 * Time: 15:44
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;

class ToggleCheckerSpy implements ToggleChecker
{
    private $toggleName;
    private $user;
    private $group;

    /**
     * @param string $toggleName
     * @param User $user
     * @param Group $group
     * @return bool is it active
     */
    public function isToggleActive( $toggleName, User $user, Group $group )
    {
        $this->toggleName = $toggleName;
        $this->user = $user;
        $this->group = $group;
        return true;
    }

    /**
     * @return mixed
     */
    public function getToggleName()
    {
        return $this->toggleName;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }
}