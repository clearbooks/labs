<?php

namespace Clearbooks\Labs\Release;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Response;
use Clearbooks\Labs\Release\UseCase\CreateRelease\ResponseModel;

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
        $response = new ResponseModel();

        if( !$this->isValidReleaseRequest( $request ) ) {
            $response->setSuccessful( false );
            $response->setErrors( [ 'Invalid request, provide a request model with a release name and url' ] );
        }

        $response->setId( $this->releaseGateway->addRelease( $request->getReleaseName(), $request->getReleaseInfoUrl() ) );
        return $response;
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function isValidReleaseRequest( Request $request )
    {
        $releaseName = $request->getReleaseName();
        $url = $request->getReleaseInfoUrl();

        return !empty($releaseName) && !empty($url);
    }
}
//EOF CreateRelease.php