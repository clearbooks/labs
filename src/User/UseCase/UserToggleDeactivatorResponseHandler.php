<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Response;

interface UserToggleDeactivatorResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF UserToggleDeactivatorResponseHandler.php
