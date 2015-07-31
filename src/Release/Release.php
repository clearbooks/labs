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
    private $isVisible;

    /**
     * Construct this Release.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param $releaseName
     * @param $releaseInfoUrl
     * @param bool $isVisible
     */
    public function __construct( $releaseName, $releaseInfoUrl, $isVisible = false )
    {
        $this->releaseName = $releaseName;
        $this->releaseInfoUrl = $releaseInfoUrl;
        $this->isVisible = $isVisible;
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

    /**
     * @return boolean
     */
    public function isIsVisible()
    {
        return $this->isVisible;
    }
}
//EOF Release.php