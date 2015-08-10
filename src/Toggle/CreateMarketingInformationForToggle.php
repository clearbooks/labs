<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 09:52
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGateway;

class CreateMarketingInformationForToggle
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
     * @param string $imageLink
     * @param string $descriptionToggle
     * @param string $descriptionFunctionally
     * @param string $descriptionOfReasonForImplementation
     * @param string $descriptionOfLocation
     * @param string $linkToGuide
     * @param string $appNotificationText
     */
    public function execute( $imageLink, $descriptionToggle, $descriptionFunctionally,
                             $descriptionOfReasonForImplementation, $descriptionOfLocation, $linkToGuide,
                             $appNotificationText )
    {

        $this->gateway->setMarketingInformationForToggle( (string) $imageLink, (string) $descriptionToggle,
            (string) $descriptionFunctionally,
            (string) $descriptionOfReasonForImplementation, (string) $descriptionOfLocation, (string) $linkToGuide,
            (string) $appNotificationText );
    }
}