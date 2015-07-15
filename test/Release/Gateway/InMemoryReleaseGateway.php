<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Release\Release;

class InMemoryReleaseGateway implements ReleaseGateway
{
    private $releases = array();

    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        new Release( $releaseName, $url );
        $id = count( $this->releases )+1;
        $this->releases[$id] = new Release( $releaseName, $url );
        return $id;
    }

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return $this->releases[ $releaseId ];
    }
}
//EOF InMemoryReleaseGateway.php