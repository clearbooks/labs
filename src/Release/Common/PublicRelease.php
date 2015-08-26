<?php

namespace Clearbooks\Labs\Release\Common;
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 17/08/2015
 * Time: 16:39
 */
interface PublicRelease
{
    /**
     * @return boolean
     */
    public function isVisible();

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate();

}