<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class ToggleActivatorResponseHandlerSpy implements ToggleActivatorResponseHandler
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
//EOF ToggleActivatorResponseHandlerSpy.php
