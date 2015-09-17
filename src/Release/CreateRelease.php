<?php

namespace Clearbooks\Labs\Release;

use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseRequest;
use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseResponse;
use Clearbooks\Labs\Release\CreateRelease\CreateReleaseResponseModel;

/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */
class CreateRelease implements UseCase\CreateRelease
{
    /**
     * @var ReleaseGateway
     */
    private $releaseGateway;

    /**
     * @param ReleaseGateway $releaseGateway
     */
    public function __construct( ReleaseGateway $releaseGateway )
    {
        $this->releaseGateway = $releaseGateway;
    }

    /**
     * @param array $errors
     * @return CreateReleaseResponse $response
     */
    private function getResponse( $errors )
    {
        $response = new CreateReleaseResponseModel();

        $response->setSuccess( empty( $errors ) );
        $response->setErrors( $errors );

        return $response;
    }

    /**
     * @param CreateReleaseRequest $request
     * @return array $errors
     */
    private function validateRequest( CreateReleaseRequest $request )
    {
        $errors = array();

        $releaseName = $request->getReleaseName();
        $url = $request->getReleaseInfoUrl();

        if ( empty( $releaseName ) ) {
            $errors[] = CreateReleaseResponse::INVALID_NAME_ERROR;
        }

        if ( empty( $url ) ) {
            $errors[] = CreateReleaseResponse::INVALID_URL_ERROR;
        }

        return $errors;
    }

    /**
     * @param CreateReleaseRequest $request
     * @return CreateReleaseResponse
     */
    public function execute( CreateReleaseRequest $request )
    {
        $errors = $this->validateRequest( $request );

        $response = $this->getResponse( $errors );

        if ( !$response->isSuccessful() ) {
            return $response;
        }

        $response->setId( $this->releaseGateway->addRelease( $request->getReleaseName(),
            $request->getReleaseInfoUrl() ) );

        return $response;
    }
}
//EOF CreateRelease.php