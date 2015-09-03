<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 12:03
 */
namespace Clearbooks\Labs\Release\UseCase;

use Clearbooks\Labs\Release\GetReleaseToggles\ResponseToggle;

interface GetReleaseToggles
{
    /**
     * @param string $releaseId
     * @return ResponseToggle[]
     */
    public function execute( $releaseId );
}