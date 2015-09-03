<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 11/08/2015
 * Time: 11:15
 */

namespace Clearbooks\Labs\Toggle\CreateMarketingInformationForToggle;


use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\MarketingInformationRequest;

class CreateMarketingInformationRequest implements MarketingInformationRequest
{
    /**
     * @var string
     */
    private $toggleId;
    /**
     * @var string
     */
    private $imageLink;
    /**
     * @var string
     */
    private $descriptionToggle;
    /**
     * @var string
     */
    private $descriptionFunctionally;
    /**
     * @var string
     */
    private $descriptionOfReasonForImplementation;
    /**
     * @var string
     */
    private $descriptionOfLocation;
    /**
     * @var string
     */
    private $linkToGuide;
    /**
     * @var string
     */
    private $appNotificationText;

    /**
     * CreateMarketingInformationRequest constructor.
     * @param string $toggleId
     * @param string $imageLink
     * @param string $descriptionOfToggle
     * @param string $descriptionOfFunctionality
     * @param string $descriptionOfReasonForImplementation
     * @param string $descriptionOfLocation
     * @param string $linkToGuide
     * @param string $appNotificationText
     */
    public function __construct( $toggleId, $imageLink = "", $descriptionOfToggle = "",
                                 $descriptionOfFunctionality = "",
                                 $descriptionOfReasonForImplementation = "", $descriptionOfLocation = "",
                                 $linkToGuide = "",
                                 $appNotificationText = "" )
    {
        $this->toggleId = $toggleId;
        $this->imageLink = $imageLink;
        $this->descriptionToggle = $descriptionOfToggle;
        $this->descriptionFunctionally = $descriptionOfFunctionality;
        $this->descriptionOfReasonForImplementation = $descriptionOfReasonForImplementation;
        $this->descriptionOfLocation = $descriptionOfLocation;
        $this->linkToGuide = $linkToGuide;
        $this->appNotificationText = $appNotificationText;
    }

    /**
     * @return mixed
     */
    public function getToggleId()
    {
        return $this->toggleId;
    }

    /**
     * @return string
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * @return string
     */
    public function getDescriptionOfToggle()
    {
        return $this->descriptionToggle;
    }

    /**
     * @return string
     */
    public function getDescriptionOfFunctionality()
    {
        return $this->descriptionFunctionally;
    }

    /**
     * @return string
     */
    public function getDescriptionOfReasonForImplementation()
    {
        return $this->descriptionOfReasonForImplementation;
    }

    /**
     * @return string
     */
    public function getDescriptionOfLocation()
    {
        return $this->descriptionOfLocation;
    }

    /**
     * @return string
     */
    public function getLinkToGuide()
    {
        return $this->linkToGuide;
    }

    /**
     * @return string
     */
    public function getAppNotificationText()
    {
        return $this->appNotificationText;
    }


}