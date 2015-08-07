<?php
namespace Clearbooks\Labs\Toggle\Entity;

class BrollyToggle implements MarketingToggle
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