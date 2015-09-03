<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:47
 */
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Entity\UserToggle;

interface GetUserTogglesForRelease
{
    /**
     * @param string $releaseId
     * @return UserToggle[]
     */
    public function execute( $releaseId );
}