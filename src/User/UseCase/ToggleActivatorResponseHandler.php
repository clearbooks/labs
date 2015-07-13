<?php
namespace User\UseCase;

use User\Object\ToggleActivatorResponse;

interface ToggleActivatorResponseHandler
{
    public function handleResponse( ToggleActivatorResponse $response );
}
//EOF ToggleActivatorResponseHandler.php
