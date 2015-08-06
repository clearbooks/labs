<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 12:25
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Release;

class DummyReleaseGateway implements ReleaseGateway
{

    /**
     * DummyReleaseGateway constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $releaseName
     * @param $url
     * @return int
     */
    public function addRelease( $releaseName, $url )
    {
    }

    /**
     * @param $releaseId
     * @return Release
     */
    public function getRelease( $releaseId )
    {
        return null;
    }

    /**
     * @return Release[]
     */
    public function getAllReleases()
    {
        return [];
    }
}