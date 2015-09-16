<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 04/08/2015
 * Time: 12:17
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

class ConfigurableVisibilityReleaseGatewayMock implements ReleaseGateway
{

    /**
     * @var boolean
     */
    private $visibility;

    function __construct( $visibility = true )
    {

        $this->visibility = $visibility;
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
     * @param string $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return new Release( 1, "", "", new \DateTime(), $this->visibility );
    }

    /**
     * @return Release[]
     */
    public function getAllReleases()
    {
        return [];
    }

    /**
     * @param string $releaseId
     * @param string $releaseName
     * @param string $releaseUrl
     * @return bool
     */
    public function editRelease( $releaseId, $releaseName, $releaseUrl )
    {
        return false;
    }
}