<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\PermissionService;
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
     * @var PermissionService
     */
    private $permissionService;

    public function __construct( ToggleStatusModifierService $toggleService, PermissionService $permissionService )
    {
        $this->toggleStatusModifierService = $toggleService;
        $this->permissionService = $permissionService;
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
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = Response::ERROR_UNKNOWN_TOGGLE;
        }

        if ( !in_array( $request->getNewToggleStatus(),
                        [ self::TOGGLE_STATUS_ACTIVE,
                          self::TOGGLE_STATUS_INACTIVE,
                          self::TOGGLE_STATUS_UNSET ] )
        ) {
            $errors[] = Response::ERROR_INVALID_TOGGLE_STATUS;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = Response::ERROR_UNKNOWN_USER;
        }

        if ( !empty( $request->getGroupIdentifier() ) ) {
            if ( $request->getGroupIdentifier() <= 0 ) {
                $errors[] = Response::ERROR_UNKNOWN_GROUP;
            }

            if ( !in_array( Response::ERROR_UNKNOWN_GROUP, $errors )
                    && !in_array( Response::ERROR_UNKNOWN_USER, $errors )
                    && !$this->permissionService->isGroupAdmin( $request->getUserIdentifier(),
                                                                $request->getGroupIdentifier() )
            ) {
                $errors[] = Response::ERROR_USER_IS_NOT_GROUP_ADMIN;
            }
        }

        return $errors;
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
