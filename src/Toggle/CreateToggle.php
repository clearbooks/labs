<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:25
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\CreateToggle\CreateToggleResponseModel;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGateway;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleRequest;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleResponse;

class CreateToggle implements UseCase\CreateToggle
{

    /**
     * @var CreateToggleGateway
     */
    private $gateway;

    /**
     * EditRelease constructor.
     * @param CreateToggleGateway $gateway
     */
    public function __construct( $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param CreateToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleName( CreateToggleRequest $request, $errors )
    {
        if ( empty( $request->getToggleName() ) ) {
            $errors[] = CreateToggleResponse::INVALID_NAME_ERROR;
        }
        return $errors;
    }

    /**
     * @param CreateToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseId( CreateToggleRequest $request, $errors )
    {
        if ( empty( $request->getToggleReleaseId() ) ) {
            $errors[] = CreateToggleResponse::INVALID_RELEASE_ID_ERROR;
        }
        return $errors;
    }

    /**
     * @param CreateToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleVisibility( CreateToggleRequest $request, $errors )
    {
        if ( !is_bool( $request->isToggleVisible() ) ) {
            $errors[] = CreateToggleResponse::INVALID_VISIBILITY_ERROR;
        }
        return $errors;
    }

    /**
     * @param CreateToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleType( CreateToggleRequest $request, $errors )
    {
        if ( $request->getToggleType() !== "simple" && $request->getToggleType() !== "group" ) {
            $errors[] = CreateToggleResponse::INVALID_TYPE_ERROR;
        }
        return $errors;
    }

    /**
     * @param CreateToggleRequest $request
     * @return string[]
     */
    private function validateRequest( CreateToggleRequest $request )
    {
        $errors = array();
        $errors = $this->validateToggleName( $request, $errors );
        $errors = $this->validateReleaseId( $request, $errors );
        $errors = $this->validateToggleVisibility( $request, $errors );
        $errors = $this->validateToggleType( $request, $errors );
        return $errors;
    }

    /**
     * @param string[] $errors
     * @return CreateToggleResponseModel
     */
    private function getResponse( $errors )
    {
        $response = new CreateToggleResponseModel();
        $response->setSuccess( empty( $errors ) );
        $response->setErrors( $errors );
        return $response;
    }

    /**
     * @param CreateToggleRequest $request
     * @return CreateToggleResponse
     */
    public function execute( CreateToggleRequest $request )
    {
        $errors = $this->validateRequest( $request );
        $response = $this->getResponse( $errors );

        if ( !$response->isSuccessful() ) {
            return $response;
        }

        $toggleId = $this->gateway->addToggle(
            $request->getToggleReleaseId(), $request->getToggleName(),
            $request->isToggleVisible(), $request->getToggleType()
        );

        if ( empty( $toggleId ) ) {
            $response->setSuccess( false );
            $response->setErrors( [ CreateToggleResponse::RELEASE_NOT_FOUND_ERROR ] );
        }

        $response->setToggleId( $toggleId );
        return $response;
    }
}