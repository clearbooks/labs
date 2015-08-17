<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\User\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivator;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleActivatorResponseHandler;

class UserToggleActivatorSpy implements UserToggleActivator
{
    /** @var int[][] */
    private $executePairs = [];

    public function execute(Request $request, UserToggleActivatorResponseHandler $responseHandler)
    {
        $this->logAndIncrementToggleUserIdCall($request);
        $this->makeASuccessfulResponse($request, $responseHandler);
    }

    /**
     * @return int[][]
     */
    public function getExecutionArray()
    {
        return $this->executePairs;
    }

    /**
     * @param Request $request
     */
    private function logAndIncrementToggleUserIdCall(Request $request)
    {
        $name = $request->getToggleIdentifier();
        $id = $request->getUserIdentifier();
        if (!isset($this->executePairs[$name])) {
            $this->executePairs[$name] = [];
        }
        if (!isset($this->executePairs[$name][$id])) {
            $this->executePairs[$name][$id] = 0;
        }
        $this->executePairs[$name][$id] = $this->executePairs[$name][$id] + 1;
    }

    /**
     * @param Request $request
     * @param UserToggleActivatorResponseHandler $responseHandler
     * @return mixed
     */
    private function makeASuccessfulResponse(Request $request, UserToggleActivatorResponseHandler $responseHandler)
    {
        return $responseHandler->handleResponse(new Response($request->getToggleIdentifier(), $request->getUserIdentifier(), []));
    }
}
//EOF UserToggleActivatorSpy.php