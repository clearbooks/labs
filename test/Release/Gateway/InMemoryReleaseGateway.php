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

    public function addRelease( $releaseName, $url )
    {
        $release = new Release( $releaseName, $url );
        $this->releases[] = $release;
        return $release;
    }


}
//EOF InMemoryReleaseGateway.php