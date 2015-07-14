<?php


namespace Clearbooks\Labs\Segment\Gateway;


class OneSegmentSegmentProviderStub implements SegmentProvider
{

    public function getSegments()
    {
        return [ null ];
    }
}