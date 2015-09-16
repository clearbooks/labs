<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 13:30
 */

namespace Clearbooks\Labs\Toggle\UseCase;


use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleRequest;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleResponse;

interface CreateToggle
{
    /**
     * @param ToggleRequest $request
     * @return ToggleResponse
     */
    public function execute( ToggleRequest $request );
}