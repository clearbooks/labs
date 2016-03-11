<?php
namespace Clearbooks\Labs\Toggle\Object;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class GetTogglesVisibleWithoutReleaseResponse
{
    /**
     * @var MarketableToggle[]
     */
    private $toggles;

    /**
     * @param MarketableToggle[] $toggles
     */
    public function __construct( array $toggles )
    {
        $this->toggles = $toggles;
    }

    /**
     * @return \Clearbooks\Labs\Toggle\Entity\MarketableToggle[]
     */
    public function getToggles()
    {
        return $this->toggles;
    }
}
