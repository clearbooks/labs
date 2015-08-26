<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;

interface ToggleStatusModifierResponseHandler
{
    public function handleResponse( Response $response );
}
//EOF ToggleStatusModifierResponseHandler.php
