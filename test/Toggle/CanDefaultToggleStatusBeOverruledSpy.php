<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\UseCase\CanDefaultToggleStatusBeOverruled;

class CanDefaultToggleStatusBeOverruledSpy implements CanDefaultToggleStatusBeOverruled
{
    /**
     * @var string
     */
    private $toggleName;

    /**
     * @var Segment[]
     */
    private $segments;

    /**
     * @param string $toggleName
     * @param Segment[] $segments
     * @return bool
     */
    public function canBeOverruled( $toggleName, array $segments )
    {
        $this->toggleName = $toggleName;
        $this->segments = $segments;
        return true;
    }

    /**
     * @return string
     */
    public function getToggleName()
    {
        return $this->toggleName;
    }

    /**
     * @return Segment[]
     */
    public function getSegments()
    {
        return $this->segments;
    }
}
