<?php
namespace User\UseCase;

use User\UseCase\ToggleActivator\Response;

interface ToggleActivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF ToggleActivatorResponseHandler.php
