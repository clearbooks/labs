<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 12:08
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

class StubReleaseGateway implements ReleaseGateway
{

    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        return 0;
    }

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return null;
    }

    /**
     * @return Release[]
     */
    public function getAllReleases()
    {
        return [ ];
    }
}