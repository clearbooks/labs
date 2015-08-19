<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;

interface ToggleStatusModifier
{
    public function execute( Request $request, ToggleStatusModifierResponseHandler $responseHandler );
}
//EOF ToggleStatusModifier.php
