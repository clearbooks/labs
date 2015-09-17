<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 14:18
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\EditRelease\EditReleaseResponseModel;
use Clearbooks\Labs\Release\EditRelease\EditResponseModel;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseRequest;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseResponse;

class EditRelease implements UseCase\EditRelease
{
    /**
     * @var ReleaseGateway
     */
    private $gateway;

    /**
     * EditRelease constructor.
     * @param ReleaseGateway $gateway
     */
    public function __construct( $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param EditReleaseRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseId( EditReleaseRequest $request, $errors )
    {
        if ( empty( $request->getReleaseId() ) ) {
            $errors[] = EditReleaseResponse::INVALID_ID_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditReleaseRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseName( EditReleaseRequest $request, $errors )
    {
        if ( empty( $request->getReleaseName() ) ) {
            $errors[] = EditReleaseResponse::INVALID_NAME_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditReleaseRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseUrl( EditReleaseRequest $request, $errors )
    {
        if ( empty( $request->getReleaseInfoUrl() ) ) {
            $errors[] = EditReleaseResponse::INVALID_URL_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditReleaseRequest $request
     * @return string[]
     */
    private function validateRequest( EditReleaseRequest $request )
    {
        $errors = array();
        $errors = $this->validateReleaseId( $request, $errors );
        $errors = $this->validateReleaseName( $request, $errors );
        $errors = $this->validateReleaseUrl( $request, $errors );
        return $errors;
    }

    /**
     * @param string[] $errors
     * @return EditReleaseResponse
     */
    private function getResponse( $errors )
    {
        $response = new EditReleaseResponseModel();
        $response->setSuccess( empty( $errors ) );
        $response->setErrors( $errors );
        return $response;
    }

    /**
     * @param EditReleaseRequest $request
     * @return EditReleaseResponse
     */
    public function execute( EditReleaseRequest $request )
    {
        $errors = $this->validateRequest( $request );
        $response = $this->getResponse( $errors );

        if ( !$response->isSuccessful() ) {
            return $response;
        }

        if ( $this->gateway->editRelease(
            $request->getReleaseId(),
            $request->getReleaseName(),
            $request->getReleaseInfoUrl()
        )
        ) {
            return $response;
        }

        $response->setSuccess( false );
        $response->setErrors( [ EditReleaseResponse::ID_NOT_FOUND ] );
        return $response;
    }
}