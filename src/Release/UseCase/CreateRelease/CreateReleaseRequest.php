<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


interface CreateReleaseRequest
{
    public function getReleaseName();

    public function getReleaseInfoUrl();
}
//EOF Request.php