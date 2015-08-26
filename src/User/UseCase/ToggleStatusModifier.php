<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;

interface ToggleStatusModifier
{
    const TOGGLE_STATUS_ACTIVE = "active";
    const TOGGLE_STATUS_INACTIVE = "inactive";
    const TOGGLE_STATUS_UNSET = "unset";

    public function execute( Request $request, ToggleStatusModifierResponseHandler $responseHandler );
}
//EOF ToggleStatusModifier.php
