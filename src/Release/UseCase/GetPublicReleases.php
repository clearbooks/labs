<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 11:58
 */
namespace Clearbooks\Labs\Release\UseCase;

use Clearbooks\Labs\Release\UseCase\GetPublicRelease\PublicRelease;

interface GetPublicReleases
{
    /**
     * If release is visible or if its time has come/passed make it visible.
     * @return PublicRelease[]
     */
    public function execute();
}