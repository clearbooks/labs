<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:40
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;

interface GetActivatedToggles
{
    /**
     * @param string $userIdentifier
     * @return ActivatableToggle[]
     */
    public function execute( $userIdentifier );
}