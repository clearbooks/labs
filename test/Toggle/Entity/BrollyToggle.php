<?php
namespace Clearbooks\Labs\Toggle\Entity;

class BrollyToggle implements MarketableToggle
{
    const NAME = "Brolly";

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
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
        return null;
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
        return null;
    }

    /**
     * @return string
     */
    public function getAppNotificationCopyText()
    {
        return null;
    }
}