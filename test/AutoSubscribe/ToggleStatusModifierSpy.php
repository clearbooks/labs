<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\User\ToggleStatusModifier\Response;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifierResponseHandler;

class ToggleStatusModifierSpy implements ToggleStatusModifier
{
    /** @var int[][] */
    private $executePairs = [];

    public function execute(Request $request, ToggleStatusModifierResponseHandler $responseHandler)
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
     * @param ToggleStatusModifierResponseHandler $responseHandler
     * @return mixed
     */
    private function makeASuccessfulResponse(Request $request, ToggleStatusModifierResponseHandler $responseHandler)
    {
        return $responseHandler->handleResponse(new Response($request->getToggleIdentifier(), $request->getUserIdentifier(), []));
    }
}
//EOF ToggleStatusModifierSpy.php