<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

interface ReleaseGateway
{
    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url );

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId );

    /**
     * @return Release[]
     */
    public function getAllReleases();
}
//EOF ReleaseGateway.php