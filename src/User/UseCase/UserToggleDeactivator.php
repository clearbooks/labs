<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Request;

interface UserToggleDeactivator
{
    public function execute( Request $request, UserToggleDeactivatorResponseHandler $responseHandler );
}
//EOF UserToggleDeactivator.php
