<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Release\Release;

class SpyReleaseGateway implements ReleaseGateway
{

    /**
     * number of times addRelease was called
     * @var int $addReleaseCalled
     */
    private $addReleaseCalled = 0;

    /**
     * Parameters supplied to addRelease
     * @var array $addReleaseParams
     */
    private $addReleaseParams = array();

    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        $this->addReleaseCalled++;
        $this->addReleaseParams[] = [ 'releaseName' => $releaseName, 'url' => $url ];

        return 1;
    }

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return new Release( 'de', 'fault', new \DateTime() );
    }

    /**
     * @return int
     */
    public function getTimesAddReleaseCalled()
    {
        return $this->addReleaseCalled;
    }

    /**
     * @return array
     */
    public function getAddReleaseParams()
    {
        return $this->addReleaseParams;
    }

    /**
     * @return Release[]
     */
    public function getAllReleases()
    {
        // TODO: Implement getAllReleases() method.
    }
}
//EOF SpyReleaseGateway.php