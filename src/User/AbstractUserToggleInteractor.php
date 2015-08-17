<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleRequest;
use Clearbooks\Labs\User\UseCase\UserToggleResponse;
use Clearbooks\Labs\User\UseCase\UserToggleService;

abstract class AbstractUserToggleInteractor
{
    /**
     * @var UserToggleService
     */
    protected $toggleService;

    public function __construct( UserToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
    }

    /**
     * @param UserToggleRequest $request
     * @return array
     */
    protected function handleUserToggleRequest( UserToggleRequest $request )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->changeToggleState( $request );

            if ( !$success ) {
                $errors[] = UserToggleResponse::ERROR_UNKNOWN_ERROR;
            }
        }

        return $errors;
    }

    /**
     * @param UserToggleRequest $request
     * @return array
     */
    protected function validateRequest( UserToggleRequest $request )
    {
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = UserToggleResponse::ERROR_UNKNOWN_TOGGLE;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = UserToggleResponse::ERROR_UNKNOWN_USER;
        }

        return $errors;
    }

    /**
     * @param UserToggleRequest $request
     * @return bool
     */
    abstract protected function changeToggleState( UserToggleRequest $request );

    /**
     * @param UserToggleRequest $request
     * @param                   $errors
     * @return UserToggleResponse
     */
    abstract protected function createResponse( UserToggleRequest $request, $errors );
}
//EOF AbstractUserToggleInteractor.php
