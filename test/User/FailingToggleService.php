<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleService;

class FailingToggleService implements ToggleService
{
    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier )
    {
        return false;
    }
}
//EOF FailingToggleService.php
