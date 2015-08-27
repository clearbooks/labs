<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 26/08/2015
 * Time: 16:21
 */

namespace Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle;


interface MarketingInformationRequest
{
    /**
     * @return mixed
     */
    public function getToggleId();

    /**
     * @return string
     */
    public function getImageLink();

    /**
     * @return string
     */
    public function getDescriptionOfToggle();

    /**
     * @return string
     */
    public function getDescriptionOfFunctionality();
    /**
     * @return string
     */
    public function getDescriptionOfReasonForImplementation();

    /**
     * @return string
     */
    public function getDescriptionOfLocation();

    /**
     * @return string
     */
    public function getLinkToGuide();

    /**
     * @return string
     */
    public function getAppNotificationText();


}