<?php
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;

interface GetUserTogglesVisibleWithoutRelease
{
    /**
     * @return GetTogglesVisibleWithoutReleaseResponse
     */
    public function execute();
}
