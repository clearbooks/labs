<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\User\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivator;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class ToggleActivatorSpy implements ToggleActivator
{
    /** @var int[][] */
    private $executePairs = [];

    public function execute(Request $request, ToggleActivatorResponseHandler $responseHandler)
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
     * @param ToggleActivatorResponseHandler $responseHandler
     * @return mixed
     */
    private function makeASuccessfulResponse(Request $request, ToggleActivatorResponseHandler $responseHandler)
    {
        return $responseHandler->handleResponse(new Response($request->getToggleIdentifier(), $request->getUserIdentifier(), []));
    }
}
//EOF ToggleActivatorSpy.php