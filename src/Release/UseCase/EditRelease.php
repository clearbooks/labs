<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 13:55
 */

namespace Clearbooks\Labs\Release\UseCase;


use Clearbooks\Labs\Release\UseCase\EditRelease\EditRequest;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditResponse;

interface EditRelease
{
    /**
     * @param EditRequest $request
     * @return EditResponse
     */
    public function execute(EditRequest $request);
}