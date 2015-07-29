<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleRequest;
use Clearbooks\Labs\User\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;

class UserToggleActivator extends AbstractUserToggleInteractor implements UseCase\UserToggleActivator
{
    public function execute( Request $request, UseCase\UserToggleActivatorResponseHandler $responseHandler )
    {
        $errors = $this->handleRequest( $request );
        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param UserToggleRequest $request
     * @return bool
     */
    protected function changeToggleState( UserToggleRequest $request )
    {
        return $this->toggleService->activateToggle( $request->getToggleIdentifier(), $request->getUserIdentifier() );
    }

    /**
     * @param UserToggleRequest $request
     * @param                   $errors
     * @return Response
     */
    protected function createResponse( UserToggleRequest $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(), $errors );
    }
}
//EOF UserToggleActivator.php
