<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 09/09/2015
 * Time: 15:21
 */

namespace Clearbooks\Labs\Toggle\Entity;


abstract class ToggleStub implements MarketableToggle
{
    protected $name;
    protected $desc;
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getScreenshotUrl()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getDescriptionOfToggle()
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getDescriptionOfFunctionality()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getDescriptionOfImplementationReason()
    {
        return null;
    }

    /**
     * @return string
     */
    public function  getDescriptionOfLocation()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getGuideUrl()
    {
        return 'http://' . get_called_class();
    }

    /**
     * @return string
     */
    public function getAppNotificationCopyText()
    {
        return null;
    }
}