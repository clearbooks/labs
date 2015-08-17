<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleRequest;
use Clearbooks\Labs\User\UserToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Request;

class UserToggleDeactivator extends AbstractUserToggleInteractor implements UseCase\UserToggleDeactivator
{
    public function execute( Request $request, UseCase\UserToggleDeactivatorResponseHandler $responseHandler )
    {
        $errors = $this->handleUserToggleRequest( $request );
        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param UserToggleRequest $request
     * @return bool
     */
    protected function changeToggleState( UserToggleRequest $request )
    {
        return $this->toggleService->deActivateToggle( $request->getToggleIdentifier(), $request->getUserIdentifier() );
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
//EOF UserToggleDeactivator.php
