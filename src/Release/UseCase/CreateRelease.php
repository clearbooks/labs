<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 21/07/15
 */

namespace Clearbooks\Labs\Release\UseCase;


use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Response;

interface CreateRelease
{
    /**
     * @param Request $request
     * @return Response
     */
    public function execute( Request $request );
}
//EOF CreateRelease.php