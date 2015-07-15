<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

interface ReleaseGateway
{
    public function addRelease( $releaseName, $url );
}
//EOF ReleaseGateway.php