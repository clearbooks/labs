<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;

interface ToggleActivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF ToggleActivatorResponseHandler.php
