<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:00
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\CreateMarketingInformationRequest;

interface CreateMarketingInformationForToggle
{
    /**
     * @param CreateMarketingInformationRequest $request
     */
    public function execute( CreateMarketingInformationRequest $request );
}