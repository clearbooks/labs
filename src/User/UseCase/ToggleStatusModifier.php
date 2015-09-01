<?php
namespace Clearbooks\Labs\User\UseCase;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Request;

interface ToggleStatusModifier
{
    const TOGGLE_STATUS_ACTIVE = "active";
    const TOGGLE_STATUS_INACTIVE = "inactive";
    const TOGGLE_STATUS_UNSET = "unset";

    /**
     * @param Request $request
     * @return Response
     */
    public function execute( Request $request );
}
//EOF ToggleStatusModifier.php
