<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:40
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;
use Clearbooks\Labs\Toggle\Object\GetActivatedTogglesRequest;

interface GetActivatedToggles
{
    /**
     * @param GetActivatedTogglesRequest $request
     * @return MarketableToggle[]
     */
    public function execute( GetActivatedTogglesRequest $request );
}
