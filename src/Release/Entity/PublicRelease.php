<?php

namespace Clearbooks\Labs\Release\Entity;
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 12/08/2015
 * Time: 10:14
 */
interface PublicRelease
{
    /**
     * @return boolean
     */
    public function isVisible();

    /**
     * @return DateTime
     */
    public function getReleaseDate();

    /**
     * @param $visivilityStatus
     */
    public function setVisible( $visivilityStatus );
}