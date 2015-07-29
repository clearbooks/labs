<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleService;

class UserToggleActivator extends AbstractUserToggleInteractor implements UseCase\UserToggleActivator
{
    /**
     * @var UserToggleService
     */
    private $toggleService;

    public function __construct( UserToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
    }

    public function execute( Request $request, UseCase\UserToggleActivatorResponseHandler $responseHandler )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->toggleService->activateToggle( $request->getToggleIdentifier(), $request->getUserIdentifier() );

            if ( !$success ) {
                $errors[] = Response::ERROR_UNKNOWN_ERROR;
            }
        }

        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param Request $request
     * @param         $errors
     * @return Response
     */
    private function createResponse( Request $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(), $errors );
    }
}
//EOF UserToggleActivator.php
