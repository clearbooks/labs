<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifierResponseHandler;

class ToggleStatusModifierResponseHandlerSpy implements ToggleStatusModifierResponseHandler
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
//EOF ToggleStatusModifierResponseHandlerSpy.php
