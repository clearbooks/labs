<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 09:52
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Entity\CreateMarketingInformationRequest;
use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGateway;
use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\MarketingInformationRequest;

class CreateMarketingInformationForToggle
{
    /**
     * @var MarketableToggleGateway
     */
    private $gateway;

    /**
     * @var array
     */
    private $marketingInformation;

    /**
     * @var string
     */
    private $toggleId;

    /**
     * CreateMarketingInformationForToggle constructor.
     * @param MarketableToggleGateway $gateway
     */
    public function __construct( MarketableToggleGateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param MarketingInformationRequest $request
     */
    public function execute( MarketingInformationRequest $request )
    {
        $toggleId = $request->getToggleId();
        $marketingInformation = [
            'screenshot_urls' => $request->getImageLink(),
            'discription_of_toggle' => $request->getDescriptionOfToggle(),
            'discription_of_functionality' => $request->getDescriptionOfFunctionality(),
            'discription_of_benefits_and_reasonForImplementation' => $request->getDescriptionOfReasonForImplementation(),
            'discription_of_location' => $request->getDescriptionOfLocation(),
            'guide_url' => $request->getLinkToGuide(),
            'app_notification_copy_text' => $request->getAppNotificationText()
        ];

        $this->gateway->setMarketingInformationForToggle( $toggleId, $marketingInformation );
    }
}