<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 12:16
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

class MockReleaseGateway implements ReleaseGateway
{
    /**
     * @var Release[]
     */
    private $releases;

    /**
     * MockReleaseGateway constructor.
     */
    public function __construct( $releases )
    {

        $this->releases = $releases;
    }

    /**
     * @param string $releaseName
     * @param string $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        return 0;
    }

    /**
     * @param int $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return $this->releases[ $releaseId ];
    }

    /**
     * @return Release[]
     */
    public function  getAllReleases()
    {
        return $this->releases;
    }
}