<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleRequest;
use Clearbooks\Labs\User\UseCase\ToggleResponse;
use Clearbooks\Labs\User\UseCase\ToggleService;

abstract class AbstractToggleInteractor
{
    /**
     * @var ToggleService
     */
    protected $toggleService;

    public function __construct( ToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
    }

    /**
     * @param ToggleRequest $request
     * @return array
     */
    protected function handleRequest( ToggleRequest $request )
    {
        $errors = $this->validateRequest( $request );

        if ( empty( $errors ) ) {
            $success = $this->changeToggleState( $request );

            if ( !$success ) {
                $errors[] = ToggleResponse::ERROR_UNKNOWN_ERROR;
            }
        }

        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @return array
     */
    protected function validateRequest( ToggleRequest $request )
    {
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = ToggleResponse::ERROR_UNKNOWN_TOGGLE;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = ToggleResponse::ERROR_UNKNOWN_USER;
        }

        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @return bool
     */
    abstract protected function changeToggleState( ToggleRequest $request );

    /**
     * @param ToggleRequest $request
     * @param                   $errors
     * @return ToggleResponse
     */
    abstract protected function createResponse( ToggleRequest $request, $errors );
}
//EOF AbstractToggleInteractor.php
