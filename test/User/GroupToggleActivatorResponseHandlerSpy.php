<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\GroupToggleActivatorResponseHandler;

class GroupToggleActivatorResponseHandlerSpy implements GroupToggleActivatorResponseHandler
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
//EOF GroupToggleActivatorResponseHandlerSpy.php
