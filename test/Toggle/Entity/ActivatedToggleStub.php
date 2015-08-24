<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 12:26
 */

namespace Clearbooks\Labs\Toggle\Entity;


class ActivatedToggleStub implements ActivatableToggle
{

    public function __construct( )
    {
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return true;
    }
}