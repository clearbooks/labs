<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\GroupToggleActivator\Response;

interface GroupToggleActivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF GroupToggleActivatorResponseHandler.php
