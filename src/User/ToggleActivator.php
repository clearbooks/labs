<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleRequest;
use Clearbooks\Labs\User\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Request;

class ToggleActivator extends AbstractToggleInteractor implements UseCase\ToggleActivator
{
    public function execute( Request $request, UseCase\ToggleActivatorResponseHandler $responseHandler )
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
        return $this->toggleService->activateToggle( $request->getToggleIdentifier(), $request->getUserIdentifier() );
    }

    /**
     * @param ToggleRequest $request
     * @param                   $errors
     * @return Response
     */
    protected function createResponse( ToggleRequest $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(), $errors );
    }
}
//EOF ToggleActivator.php
