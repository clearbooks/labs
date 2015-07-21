<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;
use Clearbooks\Labs\User\UseCase\ToggleService;

class ToggleActivator implements UseCase\ToggleActivator
{
    /**
     * @var ToggleService
     */
    private $toggleService;

    public function __construct( ToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
    }

    public function execute( Request $request, ToggleActivatorResponseHandler $responseHandler )
    {
        $errors = [ ];
        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = Response::ERROR_UNKNOWN_TOGGLE;
        }
        else {
            $success = $this->toggleService->activateToggle( $request->getToggleIdentifier() );

            if ( !$success ) {
                $errors[] = Response::ERROR_UNKNOWN_ERROR;
            }
        }

        $response = new Response();
        $response->setToggleIdentifier( $request->getToggleIdentifier() );
        $response->setErrors( $errors );

        $responseHandler->handleResponse( $response );
    }
}
//EOF ToggleActivator.php
