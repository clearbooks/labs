<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleService;

class UserToggleActivator implements UseCase\UserToggleActivator
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
            $success = $this->toggleService->activateToggle( $request->getToggleIdentifier() );

            if ( !$success ) {
                $errors[] = Response::ERROR_UNKNOWN_ERROR;
            }
        }

        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest( Request $request )
    {
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = Response::ERROR_UNKNOWN_TOGGLE;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = Response::ERROR_UNKNOWN_USER;
        }

        return $errors;
    }

    /**
     * @param Request $request
     * @param         $errors
     * @return Response
     */
    private function createResponse( Request $request, $errors )
    {
        $response = new Response();
        $response->setToggleIdentifier( $request->getToggleIdentifier() );
        $response->setUserIdentifier( $request->getUserIdentifier() );
        $response->setErrors( $errors );
        return $response;
    }
}
//EOF UserToggleActivator.php
