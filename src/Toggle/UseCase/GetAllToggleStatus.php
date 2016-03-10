<?php
namespace Clearbooks\Labs\Toggle\UseCase;

use Clearbooks\Labs\Toggle\Entity\ToggleStatus;
use Clearbooks\Labs\Toggle\Object\GetAllToggleStatusRequest;

interface GetAllToggleStatus
{
    /**
     * @param GetAllToggleStatusRequest $request
     * @return ToggleStatus[]
     */
    public function execute( GetAllToggleStatusRequest $request );
}
