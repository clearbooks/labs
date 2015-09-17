<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 15:30
 */

namespace Clearbooks\Labs\Release\EditRelease;


use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseRequest;

class EditRequestMock implements EditReleaseRequest
{
    /**
     * @var string
     */
    private $releaseId;
    /**
     * @var string
     */
    private $releaseName;
    /**
     * @var string
     */
    private $releaseUrl;

    /**
     * EditRequestMock constructor.
     * @param string $releaseId
     * @param string $releaseName
     * @param string $releaseUrl
     */
    public function __construct( $releaseId, $releaseName, $releaseUrl )
    {
        $this->releaseId = $releaseId;
        $this->releaseName = $releaseName;
        $this->releaseUrl = $releaseUrl;
    }

    /**
     * @return string
     */
    public function getReleaseId()
    {
        return $this->releaseId;
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
        return $this->releaseUrl;
    }
}