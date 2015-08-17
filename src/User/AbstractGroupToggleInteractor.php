<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleRequest;
use Clearbooks\Labs\User\UseCase\GroupToggleResponse;
use Clearbooks\Labs\User\UseCase\GroupToggleService;
use Clearbooks\Labs\User\UseCase\PermissionService;

abstract class AbstractGroupToggleInteractor extends AbstractToggleInteractor
{
    /**
     * @var GroupToggleService
     */
    protected $toggleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    public function __construct( GroupToggleService $toggleService, PermissionService $permissionService )
    {
        $this->toggleService = $toggleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @param GroupToggleRequest $request
     * @return array
     */
    protected function handleRequest( GroupToggleRequest $request )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->changeToggleState( $request );

            if ( !$success ) {
                $errors[] = GroupToggleResponse::ERROR_UNKNOWN_ERROR;
            }
        }

        return $errors;
    }

    /**
     * @param GroupToggleRequest $request
     * @return array
     */
    protected function validateRequest( GroupToggleRequest $request )
    {
        $errors = $this->validateToggleRequest( $request );

        if ( $request->getGroupIdentifier() <= 0 ) {
            $errors[] = GroupToggleResponse::ERROR_UNKNOWN_GROUP;
        }

        if ( !in_array( GroupToggleResponse::ERROR_UNKNOWN_GROUP, $errors )
                && !in_array( GroupToggleResponse::ERROR_UNKNOWN_USER, $errors )
                && !$this->permissionService->isGroupAdmin( $request->getUserIdentifier(), $request->getGroupIdentifier() )
        ) {
            $errors[] = GroupToggleResponse::ERROR_USER_IS_NOT_GROUP_ADMIN;
        }

        return $errors;
    }

    /**
     * @param GroupToggleRequest $request
     * @return bool
     */
    abstract protected function changeToggleState( GroupToggleRequest $request );

    /**
     * @param GroupToggleRequest $request
     * @param                    $errors
     * @return GroupToggleResponse
     */
    abstract protected function createResponse( GroupToggleRequest $request, $errors );
}
//EOF AbstractGroupToggleInteractor.php
