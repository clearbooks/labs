<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:35
 */

namespace Clearbooks\Labs\Toggle\CreateToggle;


use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleRequest;

class CreateToggleRequestMock implements CreateToggleRequest
{
    /**
     * @var string
     */
    private $toggleName;
    /**
     * @var string
     */
    private $toggleType;
    /**
     * @var bool
     */
    private $isVisible;
    /**
     * @var string
     */
    private $releaseId;

    /**
     * ToggleRequestDummy constructor.
     */
    public function __construct( $toggleName, $toggleType, $isVisible, $releaseId )
    {
        $this->toggleName = $toggleName;
        $this->toggleType = $toggleType;
        $this->isVisible = $isVisible;
        $this->releaseId = $releaseId;
    }

    /**
     * @return string
     */
    public function getToggleName()
    {
        return $this->toggleName;
    }

    /**
     * @return string
     */
    public function getToggleType()
    {
        return $this->toggleType;
    }

    /**
     * @return bool
     */
    public function isToggleVisible()
    {
        return $this->isVisible;
    }

    /**
     * @return string
     */
    public function getToggleReleaseId()
    {
        return $this->releaseId;
    }
}