<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;

class NameBasedToggleCheckerMock implements ToggleChecker
{
    /**
     * @var array
     */
    private $toggleStatuses = [ ];

    /**
     * @param string $toggleName
     * @param User $user
     * @param Group $group
     * @param Segment[] $segments
     * @return bool is it active
     */
    public function isToggleActive( $toggleName, User $user, Group $group, array $segments )
    {
        return isset( $this->toggleStatuses[$toggleName] ) ? $this->toggleStatuses[$toggleName] : false;
    }

    /**
     * @param string $toggleName
     * @param bool $isActive
     */
    public function setToggleStatus( $toggleName, $isActive )
    {
        $this->toggleStatuses[$toggleName] = $isActive;
    }
}
