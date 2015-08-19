<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleRequest;
use Clearbooks\Labs\User\ToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleDeactivator\Request;

class ToggleDeactivator extends AbstractToggleInteractor implements UseCase\ToggleDeactivator
{
    public function execute( Request $request, UseCase\ToggleDeactivatorResponseHandler $responseHandler )
    {
        $errors = $this->handleRequest( $request );
        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param ToggleRequest $request
     * @return bool
     */
    protected function changeToggleState( ToggleRequest $request )
    {
        if ( empty( $request->getGroupIdentifier() ) ) {
            return $this->toggleService->deActivateToggleForUser( $request->getToggleIdentifier(),
                                                                  $request->getUserIdentifier() );
        }

        return $this->toggleService->deActivateToggleForGroup( $request->getToggleIdentifier(),
                                                               $request->getGroupIdentifier(),
                                                               $request->getUserIdentifier() );
    }

    /**
     * @param ToggleRequest $request
     * @param                   $errors
     * @return Response
     */
    protected function createResponse( ToggleRequest $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(),
                             $request->getGroupIdentifier(), $errors );
    }
}
//EOF ToggleDeactivator.php
