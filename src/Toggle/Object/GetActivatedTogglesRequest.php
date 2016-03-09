<?php
namespace Clearbooks\Labs\Toggle\Object;

use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\Entity\User;

class GetActivatedTogglesRequest
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Group
     */
    private $group;

    /**
     * @var Segment[]
     */
    private $segments;

    /**
     * @param User $user
     * @param Group $group
     * @param Segment[] $segments
     */
    public function __construct( User $user, Group $group, array $segments )
    {
        $this->user = $user;
        $this->group = $group;
        $this->segments = $segments;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return \Clearbooks\Labs\Client\Toggle\Entity\Segment[]
     */
    public function getSegments()
    {
        return $this->segments;
    }
}
