<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 26/08/2015
 * Time: 14:11
 */

namespace Clearbooks\Labs\Release\Gateway;


interface PublicReleaseGateway
{
    /**
     * @return PublicRelease[]
     */
    public function getAllPublicReleases();
}