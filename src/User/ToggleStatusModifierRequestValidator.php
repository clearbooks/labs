<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\PermissionService;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;

class ToggleStatusModifierRequestValidator
{
    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * @var array
     */
    private $errors = [ ];

    public function __construct( PermissionService $permissionService )
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validate( Request $request )
    {
        $this->clearErrors();
        $this->validateToggleIdentifier( $request );
        $this->validateNewToggleStatus( $request );
        $this->validateUserIdentifier( $request );
        $this->validateGroupRelatedInput( $request );

        return $this->errors;
    }

    private function clearErrors()
    {
        $this->errors = [ ];
    }

    private function validateToggleIdentifier( Request $request )
    {
        if ( empty( $request->getToggleIdentifier() ) ) {
            $this->errors[] = Response::ERROR_UNKNOWN_TOGGLE;
        }
    }

    private function validateNewToggleStatus( Request $request )
    {
        if ( !in_array( $request->getNewToggleStatus(),
                        [ ToggleStatusModifier::TOGGLE_STATUS_ACTIVE,
                          ToggleStatusModifier::TOGGLE_STATUS_INACTIVE,
                          ToggleStatusModifier::TOGGLE_STATUS_UNSET ] )
        ) {
            $this->errors[] = Response::ERROR_INVALID_TOGGLE_STATUS;
        }
    }

    private function validateUserIdentifier( Request $request )
    {
        if ( $request->getUserIdentifier() <= 0 ) {
            $this->errors[] = Response::ERROR_UNKNOWN_USER;
        }
    }

    private function validateGroupRelatedInput( Request $request )
    {
        if ( empty( $request->getGroupIdentifier() ) ) {
            return;
        }

        $this->validateGroupIdentifier( $request );
        $this->validateIfActingUserIsGroupAdmin( $request );
    }

    private function validateGroupIdentifier( Request $request )
    {
        if ( $request->getGroupIdentifier() <= 0 ) {
            $this->errors[] = Response::ERROR_UNKNOWN_GROUP;
        }
    }

    private function validateIfActingUserIsGroupAdmin( Request $request )
    {
        if ( !in_array( Response::ERROR_UNKNOWN_GROUP, $this->errors )
                && !in_array( Response::ERROR_UNKNOWN_USER, $this->errors )
                && !$this->permissionService->isGroupAdmin( $request->getUserIdentifier(),
                                                            $request->getGroupIdentifier() )
        ) {
            $this->errors[] = Response::ERROR_USER_IS_NOT_GROUP_ADMIN;
        }
    }
}
//EOF ToggleStatusModifierRequestValidator.php
