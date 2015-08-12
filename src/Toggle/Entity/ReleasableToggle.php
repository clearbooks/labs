<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 04/08/2015
 * Time: 12:38
 */

namespace Clearbooks\Labs\Toggle\Entity;


interface ReleasableToggle
{
    /**
     * @return string
     */
    public function getRelease();
}