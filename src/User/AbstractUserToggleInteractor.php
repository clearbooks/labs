<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleRequest;
use Clearbooks\Labs\User\UseCase\UserToggleResponse;

abstract class AbstractUserToggleInteractor
{
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
}
//EOF AbstractUserToggleInteractor.php
