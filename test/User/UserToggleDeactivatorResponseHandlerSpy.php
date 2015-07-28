<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleDeactivatorResponseHandler;

class UserToggleDeactivatorResponseHandlerSpy implements UserToggleDeactivatorResponseHandler
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
//EOF UserUserToggleDeactivatorResponseHandlerSpy.php
