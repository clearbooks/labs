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
     * @var
     */
    private $visibility;

    function __construct( $visibility = true )
    {

        $this->visibility = $visibility;
    }


    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
        return 0;
    }

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return new Release( "", "", new \DateTime(), $this->visibility );
    }

    /**
     * @return Release[]
     */
    public function getAllReleases()
    {
        return [];
    }
}