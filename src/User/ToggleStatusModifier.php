<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifierService;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\ToggleStatusModifier\Response;

class ToggleStatusModifier implements UseCase\ToggleStatusModifier
{
    /**
     * @var ToggleStatusModifierService
     */
    private $toggleStatusModifierService;

    /**
     * @var ToggleStatusModifierRequestValidator
     */
    private $toggleStatusModifierRequestValidator;

    public function __construct( ToggleStatusModifierService $toggleService, ToggleStatusModifierRequestValidator $toggleStatusModifierRequestValidator )
    {
        $this->toggleStatusModifierService = $toggleService;
        $this->toggleStatusModifierRequestValidator = $toggleStatusModifierRequestValidator;
    }

    public function execute( Request $request, UseCase\ToggleStatusModifierResponseHandler $responseHandler )
    {
        $errors = $this->handleRequest( $request );
        $response = $this->createResponse( $request, $errors );
        $responseHandler->handleResponse( $response );
    }

    /**
     * @param Request $request
     * @return array
     */
    private function handleRequest( Request $request )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->changeToggleStatus( $request );

            if ( !$success ) {
                $errors[] = Response::ERROR_UNKNOWN_ERROR;
            }
        }

        return $errors;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest( Request $request )
    {
        return $this->toggleStatusModifierRequestValidator->validate( $request );
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function changeToggleStatus( Request $request )
    {
        if ( empty( $request->getGroupIdentifier() ) ) {
            return $this->toggleStatusModifierService->setToggleStatusForUser( $request->getToggleIdentifier(),
                                                                               $request->getNewToggleStatus(),
                                                                               $request->getUserIdentifier() );
        }

        return $this->toggleStatusModifierService->setToggleStatusForGroup( $request->getToggleIdentifier(),
                                                                            $request->getNewToggleStatus(),
                                                                            $request->getGroupIdentifier(),
                                                                            $request->getUserIdentifier() );
    }

    /**
     * @param Request $request
     * @param                   $errors
     * @return Response
     */
    private function createResponse( Request $request, $errors )
    {
        return new Response( $request->getToggleIdentifier(), $request->getNewToggleStatus(),
                             $request->getUserIdentifier(), $request->getGroupIdentifier(), $errors );
    }
}
//EOF ToggleStatusModifier.php
