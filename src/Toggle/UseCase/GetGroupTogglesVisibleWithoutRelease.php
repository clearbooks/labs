<?php
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;

interface GetGroupTogglesVisibleWithoutRelease
{
    /**
     * @return GetTogglesVisibleWithoutReleaseResponse
     */
    public function execute();
}
