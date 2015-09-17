<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 13:30
 */

namespace Clearbooks\Labs\Toggle\UseCase;


use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleRequest;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleResponse;

interface CreateToggle
{
    /**
     * @param CreateToggleRequest $request
     * @return CreateToggleResponse
     */
    public function execute( CreateToggleRequest $request );
}