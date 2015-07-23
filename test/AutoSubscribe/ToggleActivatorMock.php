<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 13:30
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\User\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivator;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class ToggleActivatorMock implements ToggleActivator
{
    /** @var string */
    private $executedToggle;

    public function execute(Request $request, ToggleActivatorResponseHandler $responseHandler)
    {
        $response = new Response();
        $response->setErrors([]);
        $response->setToggleIdentifier($request->getToggleIdentifier());
        $this->executedToggle = $request->getToggleIdentifier();
        $responseHandler->handleResponse($response);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isExecuteCalledWithToggleName($name)
    {
        return $this->executedToggle === $name;
    }
}
//EOF ToggleActivatorMock.php