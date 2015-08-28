<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use DateTimeInterface;

class Release implements Entity\PublicRelease, UseCase\GetPublicRelease\PublicRelease
{

    /**
     * @var string
     */
    private $releaseName;
    /**
     * @var string
     */
    private $releaseInfoUrl;
    /**
     * @var bool
     */
    private $isVisible;
    /**
     * @var DateTimeInterface
     */
    private $releaseDate;
    /**
     * @var string
     */
    private $releaseId;

    /**
     * Construct this Release.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param string $releaseId
     * @param string $releaseName
     * @param string $releaseInfoUrl
     * @param DateTimeInterface $releaseDate
     * @param bool $isVisible
     */
    public function __construct( $releaseId, $releaseName, $releaseInfoUrl, DateTimeInterface $releaseDate, $isVisible = false )
    {
        $this->releaseName = $releaseName;
        $this->releaseInfoUrl = $releaseInfoUrl;
        $this->isVisible = $isVisible;
        $this->releaseDate = $releaseDate;
        $this->releaseId = $releaseId;
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

    /**
     * @return string
     */
    public function getReleaseId()
    {
        return $this->releaseId;
    }
}
//EOF Release.php