<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 09/09/2015
 * Time: 14:54
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;

class FailingToggleCheckerStub implements ToggleChecker
{
    /**
     * @param string $toggleName
     * @param User $user
     * @param Group $group
     * @param Segment[] $segments
     * @return bool is it active
     */
    public function isToggleActive( $toggleName, User $user, Group $group, array $segments )
    {
        return false;
    }
}
