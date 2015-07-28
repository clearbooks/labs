<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleService;

class UserToggleDeactivator implements UseCase\UserToggleDeactivator
{
    /**
     * @var UserToggleService
     */
    private $toggleService;

    public function __construct( UserToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
    }

    public function execute( Request $request, UseCase\UserToggleDeactivatorResponseHandler $responseHandler )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->toggleService->deActivateToggle( $request->getToggleIdentifier(), $request->getUserIdentifier() );

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
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(), $errors );
    }
}
//EOF UserToggleDeactivator.php
