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

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request)
    {
        $this->logAndIncrementToggleUserIdCall($request);
        return $this->makeASuccessfulResponse($request);
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
     * @return mixed
     */
    private function makeASuccessfulResponse(Request $request)
    {
        return new Response($request->getToggleIdentifier(), $request->getUserIdentifier(), []);
    }
}
//EOF ToggleStatusModifierSpy.php