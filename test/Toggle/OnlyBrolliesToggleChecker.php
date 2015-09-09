<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 09/09/2015
 * Time: 15:12
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;
use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class OnlyBrolliesToggleChecker implements ToggleChecker
{
    /**
     * @var Entity\MarketableToggle[]
     */
    private $toggles;

    /**
     * ToggleCheckerFake constructor.
     * @param MarketableToggle[] $toggles
     */
    public function __construct( $toggles )
    {
        $this->toggles = $toggles;
    }

    /**
     * @param string $toggleName
     * @param User $user
     * @param Group $group
     * @return bool is it active
     */
    public function isToggleActive( $toggleName, User $user, Group $group )
    {
        return $toggleName === ( new Brolly() )->getName();
    }
}