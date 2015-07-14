<?php


namespace Clearbooks\Labs\Segment\Gateway;

use Clearbooks\Labs\Segment\Segment;

interface SegmentProvider
{
    /**
     * @return Segment[]
     */
    public function getSegments();
}