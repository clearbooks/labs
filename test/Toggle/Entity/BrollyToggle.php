<?php
namespace Clearbooks\Labs\Toggle\Entity;

class BrollyToggle implements MarketableToggle
{
    const NAME = "Brolly";

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

}