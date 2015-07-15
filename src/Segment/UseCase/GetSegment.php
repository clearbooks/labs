<?php
namespace Clearbooks\Labs\Segment\UseCase;

use Clearbooks\Labs\Segment\UseCase\GetSegment\Response;

interface GetSegment
{
    /**
     * @param string $segmentId
     * @return Response
     */
    public function execute($segmentId);
}