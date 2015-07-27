<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


class Release
{
    private $releaseName;
    private $releaseInfoUrl;

    /**
     * Construct this Release.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param $releaseName
     * @param $releaseInfoUrl
     */
    public function __construct( $releaseName, $releaseInfoUrl )
    {
        $this->releaseName = $releaseName;
        $this->releaseInfoUrl = $releaseInfoUrl;
    }

    /**
     * @return string
     */
    public function getReleaseName()
    {
        return $this->releaseName;
    }

    /**
     * @return string
     */
    public function getReleaseInfoUrl()
    {
        return $this->releaseInfoUrl;
    }
}
//EOF Release.php