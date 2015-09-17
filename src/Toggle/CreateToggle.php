<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:25
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\CreateToggle\ToggleResponseModel;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGateway;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle as ICreateToggle;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleRequest;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleResponse;

class CreateToggle implements ICreateToggle
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
     * @param ToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleName( ToggleRequest $request, $errors )
    {
        if ( empty( $request->getToggleName() ) ) {
            $errors[] = ToggleResponse::INVALID_NAME_ERROR;
        }
        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseId( ToggleRequest $request, $errors )
    {
        if ( empty( $request->getToggleReleaseId() ) ) {
            $errors[] = ToggleResponse::INVALID_RELEASE_ID_ERROR;
        }
        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleVisibility( ToggleRequest $request, $errors )
    {
        if ( !is_bool( $request->isToggleVisible() ) ) {
            $errors[] = ToggleResponse::INVALID_VISIBILITY_ERROR;
        }
        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @param $errors
     * @return array
     */
    private function validateToggleType( ToggleRequest $request, $errors )
    {
        if ( $request->getToggleType() !== "simple" && $request->getToggleType() !== "group" ) {
            $errors[] = ToggleResponse::INVALID_TYPE_ERROR;
        }
        return $errors;
    }

    /**
     * @param ToggleRequest $request
     * @return string[]
     */
    private function validateRequest( ToggleRequest $request )
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
     * @return ToggleResponseModel
     */
    private function getResponse( $errors )
    {
        $response = new ToggleResponseModel();
        $response->setSuccess( empty( $errors ) );
        $response->setErrors( $errors );
        return $response;
    }

    /**
     * @param ToggleRequest $request
     * @return ToggleResponse
     */
    public function execute( ToggleRequest $request )
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
            $response->setErrors( [ ToggleResponse::RELEASE_NOT_FOUND_ERROR ] );
        }

        $response->setToggleId( $toggleId );
        return $response;
    }
}