<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:40
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

interface GetActivatedToggles
{
    /**
     * @param User $user
     * @param Group $group
     * @return MarketableToggle[]
     */
    public function execute( User $user, Group $group );
}