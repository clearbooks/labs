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
        $errors = [ ];
        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = Response::ERROR_UNKNOWN_TOGGLE;
        }
        else if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = Response::ERROR_UNKNOWN_USER;
        }
        else {
            $success = $this->toggleService->activateToggle( $request->getToggleIdentifier() );

            if ( !$success ) {
                $errors[] = Response::ERROR_UNKNOWN_ERROR;
            }
        }

        $response = new Response();
        $response->setToggleIdentifier( $request->getToggleIdentifier() );
        $response->setUserIdentifier( $request->getUserIdentifier() );
        $response->setErrors( $errors );

        $responseHandler->handleResponse( $response );
    }
}
//EOF UserToggleActivator.php
