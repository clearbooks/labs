<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Request;

interface ToggleActivator
{
    public function execute( Request $request, ToggleActivatorResponseHandler $responseHandler );
}
//EOF ToggleActivator.php
