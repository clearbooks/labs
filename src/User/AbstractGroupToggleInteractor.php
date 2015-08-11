<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleRequest;
use Clearbooks\Labs\User\UseCase\GroupToggleResponse;
use Clearbooks\Labs\User\UseCase\GroupToggleService;

abstract class AbstractGroupToggleInteractor
{
    /**
     * @var GroupToggleService
     */
    protected $toggleService;

    public function __construct( GroupToggleService $toggleService )
    {
        $this->toggleService = $toggleService;
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
        $errors = [ ];

        if ( empty( $request->getToggleIdentifier() ) ) {
            $errors[] = GroupToggleResponse::ERROR_UNKNOWN_TOGGLE;
        }

        if ( $request->getGroupIdentifier() <= 0 ) {
            $errors[] = GroupToggleResponse::ERROR_UNKNOWN_GROUP;
        }

        if ( $request->getUserIdentifier() <= 0 ) {
            $errors[] = GroupToggleResponse::ERROR_UNKNOWN_USER;
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
