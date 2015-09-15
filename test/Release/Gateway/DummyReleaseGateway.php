<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 12:25
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

class DummyReleaseGateway implements ReleaseGateway
{

    /**
     * @param string $releaseName
     * @param string $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        return 0;
    }

    /**
     * @param string $releaseId
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
        return [];
    }

    /**
     * @param string $releaseId
     * @param string $releaseName
     * @param string $releaseUrl
     * @return bool
     */
    public function editRelease( $releaseId, $releaseName, $releaseUrl )
    {
        return false;
    }
}