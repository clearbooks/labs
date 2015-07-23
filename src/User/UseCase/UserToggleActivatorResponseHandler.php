<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\UserToggleActivator\Response;

interface UserToggleActivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF UserToggleActivatorResponseHandler.php
