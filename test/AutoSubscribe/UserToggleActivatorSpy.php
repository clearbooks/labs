<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 13:30
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\User\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivator;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleActivatorResponseHandler;

class UserToggleActivatorSpy implements UserToggleActivator
{
    /** @var array */
    private $executePairs = [];

    public function execute(Request $request, UserToggleActivatorResponseHandler $responseHandler)
    {
        $response = new Response($request->getToggleIdentifier(),$request->getUserIdentifier(),[]);
        ++$this->executePairs[$request->getToggleIdentifier()][$request->getUserIdentifier()];
        $responseHandler->handleResponse($response);
    }

    /**
     * @return array
     */
    public function getExecutionArray()
    {
        return $this->executePairs;
    }
}
//EOF UserToggleActivatorSpy.php