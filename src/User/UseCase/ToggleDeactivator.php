<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleDeactivator\Request;

interface ToggleDeactivator
{
    public function execute( Request $request, ToggleDeactivatorResponseHandler $responseHandler );
}
//EOF ToggleDeactivator.php
