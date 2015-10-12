<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 09:52
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGateway;
use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\CreateMarketingInformationRequest;

class CreateMarketingInformationForToggle implements UseCase\CreateMarketingInformationForToggle
{
    /**
     * @var MarketableToggleGateway
     */
    private $gateway;

    /**
     * CreateMarketingInformationForToggle constructor.
     * @param MarketableToggleGateway $gateway
     */
    public function __construct( MarketableToggleGateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param CreateMarketingInformationRequest $request
     */
    public function execute( CreateMarketingInformationRequest $request )
    {
        $toggleId = $request->getToggleId();
        $marketingInformation = [
            'screenshot_urls' => $request->getImageLink(),
            'description_of_toggle' => $request->getDescriptionOfToggle(),
            'description_of_functionality' => $request->getDescriptionOfFunctionality(),
            'description_of_implementation_reason' => $request->getDescriptionOfReasonForImplementation(),
            'description_of_location' => $request->getDescriptionOfLocation(),
            'guide_url' => $request->getLinkToGuide(),
            'app_notification_copy_text' => $request->getAppNotificationText(),
            'toggle_title' => $request->getMarketingToggleTitle()
        ];

        $this->gateway->setMarketingInformationForToggle( $toggleId, $marketingInformation );
    }
}