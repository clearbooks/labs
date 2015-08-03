<?php

namespace Clearbooks\Labs\Release;

use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Response;
use Clearbooks\Labs\Release\CreateRelease\ResponseModel;

/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */
class CreateRelease implements \Clearbooks\Labs\Release\UseCase\CreateRelease
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
     * @param Request $request
     * @return Response
     */
    public function execute( Request $request )
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

    /**
     * @param array $errors
     * @return ResponseModel $response
     */
    private function getResponse( $errors )
    {
        $response = new ResponseModel();

        $response->setSuccessful( empty( $errors ) );
        $response->setErrors( $errors );

        return $response;
    }

    /**
     * @param Request $request
     * @return array $errors
     */
    private function validateRequest( Request $request )
    {
        $errors = array();

        $releaseName = $request->getReleaseName();
        $url = $request->getReleaseInfoUrl();

        if ( empty( $releaseName ) ) {
            $errors[] = Response::INVALID_NAME_ERROR;
        }

        if ( empty( $url ) ) {
            $errors[] = Response::INVALID_URL_ERROR;
        }

        return $errors;
    }
}
//EOF CreateRelease.php