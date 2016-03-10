<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\UseCase\CanDefaultToggleStatusBeOverruled;

class NameBasedCanDefaultToggleStatusBeOverruledMock implements CanDefaultToggleStatusBeOverruled
{
    /**
     * @var array
     */
    private $toggleList;

    /**
     * @param string $toggleName
     * @param Segment[] $segments
     * @return bool
     */
    public function canBeOverruled( $toggleName, array $segments )
    {
        return isset( $this->toggleList[$toggleName] ) ? $this->toggleList[$toggleName] : true;
    }

    /**
     * @param string $toggleName
     * @param bool $canBeOverruled
     */
    public function setToggleCanBeOverruled( $toggleName, $canBeOverruled )
    {
        $this->toggleList[$toggleName] = $canBeOverruled;
    }
}
