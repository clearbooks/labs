<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleDeactivatorResponseHandler;

class ToggleDeactivatorResponseHandlerSpy implements ToggleDeactivatorResponseHandler
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
//EOF ToggleDeactivatorResponseHandlerSpy.php
