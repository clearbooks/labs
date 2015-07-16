<?php
namespace Clearbooks\Labs\Segment\UseCase;

use Clearbooks\Labs\Segment\UseCase\GetAllSegments\Response;

interface GetAllSegments
{
    /**
     * @return Response
     */
    public function execute();
}