<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:21
 */

namespace Clearbooks\Labs\Toggle\Gateway;


interface CreateToggleGateway
{
    /**
     * @param string $releaseId
     * @param string $toggleName
     * @param bool $visibility
     * @param string $toggleType
     * @return bool
     */
    public function addToggle( $releaseId, $toggleName, $visibility, $toggleType );
}