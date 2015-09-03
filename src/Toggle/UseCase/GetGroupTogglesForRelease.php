<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:46
 */
namespace Clearbooks\Labs\Toggle\UseCase;

interface GetGroupTogglesForRelease
{
    public function execute( $releaseId );
}