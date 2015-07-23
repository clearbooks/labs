<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivatorResponseHandler;

class UserToggleActivatorResponseHandlerSpy implements UserToggleActivatorResponseHandler
{
    /**
     * @var Response
     */
    private $lastHandledResponse;

    public function handleResponse( Response $response )
    {
        $this->lastHandledResponse = $response;
    }

    /**
     * @return Response
     */
    public function getLastHandledResponse()
    {
        return $this->lastHandledResponse;
    }
}
//EOF UserUserToggleActivatorResponseHandlerSpy.php
