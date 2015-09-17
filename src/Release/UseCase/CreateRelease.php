<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 21/07/15
 */

namespace Clearbooks\Labs\Release\UseCase;


use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseRequest;
use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseResponse;

interface CreateRelease
{
    /**
     * @param CreateReleaseRequest $request
     * @return CreateReleaseResponse
     */
    public function execute( CreateReleaseRequest $request );
}
//EOF CreateRelease.php