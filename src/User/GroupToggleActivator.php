<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleRequest;
use Clearbooks\Labs\User\GroupToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\GroupToggleActivator\Request;

class GroupToggleActivator extends AbstractGroupToggleInteractor implements UseCase\GroupToggleActivator
{
    public function execute( Request $request, UseCase\GroupToggleActivatorResponseHandler $responseHandler )
    {
        $errors = $this->handleGroupToggleRequest( $request );
        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param GroupToggleRequest $request
     * @return bool
     */
    protected function changeToggleState( GroupToggleRequest $request )
    {
        return $this->toggleService->activateToggle( $request->getToggleIdentifier(), $request->getGroupIdentifier(), $request->getUserIdentifier() );
    }

    /**
     * @param GroupToggleRequest $request
     * @param                    $errors
     * @return Response
     */
    protected function createResponse( GroupToggleRequest $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getGroupIdentifier(),
                             $request->getUserIdentifier(), $errors );
    }
}
//EOF UserToggleActivator.php
