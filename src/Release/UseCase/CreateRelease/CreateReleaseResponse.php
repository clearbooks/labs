<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;

use \Clearbooks\Labs\Response\UseCase\Response;

interface CreateReleaseResponse extends Response
{
    const INVALID_NAME_ERROR = 11;
    const INVALID_URL_ERROR = 12;

    /**
     * @return string
     */
    public function getReleaseId();
}
//EOF Response.php