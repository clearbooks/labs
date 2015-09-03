<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:00
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\MarketingInformationRequest;

interface CreateMarketingInformationForToggle
{
    /**
     * @param MarketingInformationRequest $request
     */
    public function execute( MarketingInformationRequest $request );
}