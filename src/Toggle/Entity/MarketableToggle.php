<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 07/08/2015
 * Time: 09:40
 */

namespace Clearbooks\Labs\Toggle\Entity;


interface MarketableToggle
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getScreenshotUrl();

    /**
     * @return string
     */
    public function getDetdescriptionOfToggle();

    /**
     * @return string
     */
    public function getDescriptionOfFunctionality();

    /**
     * @return string
     */
    public function getDescriptionOfImplementationReason();

    /**
     * @return string
     */
    public function  getDescriptionOfLocation();

    /**
     * @return string
     */
    public function getGuideUrl();

    /**
     * @return string
     */
    public function getAppNotificationCopyText();
}