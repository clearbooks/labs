<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use DateTime;

class Release implements Entity\PublicRelease, UseCase\GetPublicRelease\PublicRelease
{
    private $releaseName;
    private $releaseInfoUrl;
    private $isVisible;
    private $releaseDate;

    /**
     * Construct this Release.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param $releaseName
     * @param $releaseInfoUrl
     * @param $releaseDate
     * @param bool $isVisible
     */
    public function __construct( $releaseName, $releaseInfoUrl, DateTime $releaseDate, $isVisible = false )
    {
        $this->releaseName = $releaseName;
        $this->releaseInfoUrl = $releaseInfoUrl;
        $this->isVisible = $isVisible;
        $this->releaseDate = $releaseDate;
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
    public function isVisible()
    {
        return $this->isVisible;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setVisible( $flag )
    {
        $this->isVisible = $flag;
    }
}
//EOF Release.php