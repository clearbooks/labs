<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleRequest;
use Clearbooks\Labs\User\UseCase\ToggleResponse;

abstract class AbstractToggleInteractor
{
    /**
     * @param ToggleRequest $request
     * @return array
     */
    protected function validateToggleRequest( ToggleRequest $request ) {
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = ToggleResponse::ERROR_UNKNOWN_TOGGLE;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = ToggleResponse::ERROR_UNKNOWN_USER;
        }

        return $errors;
    }
}
//EOF AbstractToggleInteractor.php
