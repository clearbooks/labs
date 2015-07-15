<?php

namespace Clearbooks\Labs\Release;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;

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
     * @return int|bool
     */
    public function execute( Request $request )
    {
        if( !$this->isValidReleaseRequest( $request ) ) {
            return false;
        }

        return $this->releaseGateway->addRelease( $request->getReleaseName(), $request->getReleaseInfoUrl() );
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