<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;

interface UserToggleActivator
{
    public function execute( Request $request, UserToggleActivatorResponseHandler $responseHandler );
}
//EOF UserToggleActivator.php
