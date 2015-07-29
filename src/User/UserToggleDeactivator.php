<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleDeactivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleService;

class UserToggleDeactivator extends AbstractUserToggleInteractor implements UseCase\UserToggleDeactivator
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
     * @param         $errors
     * @return Response
     */
    private function createResponse( Request $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getUserIdentifier(), $errors );
    }
}
//EOF UserToggleDeactivator.php
