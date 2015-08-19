<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleDeactivator\Response;

interface ToggleDeactivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF ToggleDeactivatorResponseHandler.php
