<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 13:55
 */

namespace Clearbooks\Labs\Release\UseCase;


use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseRequest;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseResponse;

interface EditRelease
{
    /**
     * @param EditReleaseRequest $request
     * @return EditReleaseResponse
     */
    public function execute( EditReleaseRequest $request );
}