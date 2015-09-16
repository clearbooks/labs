<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 14:18
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\EditRelease\EditResponseModel;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditRequest;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditResponse;
use Clearbooks\Labs\Release\UseCase\EditRelease as IEditRelease;

class EditRelease implements IEditRelease
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
     * @param EditRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseId( EditRequest $request, $errors )
    {
        if ( empty( $request->getReleaseId() ) ) {
            $errors[] = EditResponse::INVALID_ID_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseName( EditRequest $request, $errors )
    {
        if ( empty( $request->getReleaseName() ) ) {
            $errors[] = EditResponse::INVALID_NAME_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditRequest $request
     * @param $errors
     * @return array
     */
    private function validateReleaseUrl( EditRequest $request, $errors )
    {
        if ( empty( $request->getReleaseInfoUrl() ) ) {
            $errors[] = EditResponse::INVALID_URL_ERROR;
            return $errors;
        }
        return $errors;
    }

    /**
     * @param EditRequest $request
     * @return string[]
     */
    private function validateRequest( EditRequest $request )
    {
        $errors = array();
        $errors = $this->validateReleaseId( $request, $errors );
        $errors = $this->validateReleaseName( $request, $errors );
        $errors = $this->validateReleaseUrl( $request, $errors );
        return $errors;
    }

    /**
     * @param string[] $errors
     * @return EditResponseModel
     */
    private function getResponse( $errors )
    {
        $response = new EditResponseModel();
        $response->setSuccess( empty( $errors ) );
        $response->setErrors( $errors );
        return $response;
    }

    /**
     * @param EditRequest $request
     * @return EditResponse
     */
    public function execute( EditRequest $request )
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
        $response->setErrors( [ EditResponse::ID_NOT_FOUND ] );
        return $response;
    }
}