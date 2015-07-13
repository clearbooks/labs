<?php
namespace User\UseCase;

use User\UseCase\ToggleActivator\Request;

interface ToggleActivator
{
    public function execute( Request $request, ToggleActivatorResponseHandler $responseHandler );
}
//EOF ToggleActivator.php
