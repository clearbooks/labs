<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\GroupToggleActivator\Request;

interface GroupToggleActivator
{
    public function execute( Request $request, GroupToggleActivatorResponseHandler $responseHandler );
}
//EOF GroupToggleActivator.php
