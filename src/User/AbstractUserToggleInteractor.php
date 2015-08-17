<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleRequest;
use Clearbooks\Labs\User\UseCase\UserToggleResponse;
use Clearbooks\Labs\User\UseCase\UserToggleService;

abstract class AbstractUserToggleInteractor extends AbstractToggleInteractor
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
    protected function handleRequest( UserToggleRequest $request )
    {
        $errors = $this->validateToggleRequest( $request );

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
