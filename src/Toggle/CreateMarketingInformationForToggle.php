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
     * @param CreateMarketingInformationRequest $request
     */
    public function execute( CreateMarketingInformationRequest $request )
    {

        $this->gateway->setMarketingInformationForToggle( $request );
    }
}