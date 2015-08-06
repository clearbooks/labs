<?php
namespace Clearbooks\Labs\Toggle\Entity;

class BrollyToggle implements Toggle
{
    const NAME = "Brolly";

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @return int
     */
    public function getRelease()
    {
    }
}