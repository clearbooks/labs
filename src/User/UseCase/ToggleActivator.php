<?php
namespace User\UseCase;

use User\Object\ToggleActivatorRequest;

interface ToggleActivator
{
    public function execute( ToggleActivatorRequest $request, ToggleActivatorResponseHandler $responseHandler );
}
//EOF ToggleActivator.php
