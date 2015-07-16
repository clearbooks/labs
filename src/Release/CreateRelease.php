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
class CreateRelease
{
    /**
     * @var ReleaseGateway
     */
    private $releaseGateway;

    /**
     * @param ReleaseGateway $releaseGateway
     */
    function __construct( ReleaseGateway $releaseGateway )
    {
        $this->releaseGateway = $releaseGateway;
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function execute( Request $request )
    {
        $response = $this->getResponse( $request );

        if( !$response->isSuccessful() ) {
            return $response;
        }

        $response->setId( $this->releaseGateway->addRelease( $request->getReleaseName(), $request->getReleaseInfoUrl() ) );

        return $response;
    }

    /**
     * @param Request $request
     * @return ResponseModel $response
     */
    private function getResponse( Request $request )
    {
        $response = new ResponseModel();

        $releaseName = $request->getReleaseName();
        $url = $request->getReleaseInfoUrl();

        $errors= [];
        $successful = true;

        if( empty( $releaseName ) ){
            $errors[] = Response::INVALID_NAME_ERROR;
            $successful = false;
        }

        if( empty( $url ) ){
            $errors[] = Response::INVALID_URL_ERROR;
            $successful = false;
        }

        $response->setErrors( $errors );
        $response->setSuccessful( $successful );

        return $response;
    }
}
//EOF CreateRelease.php