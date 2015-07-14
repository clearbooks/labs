<?php


namespace Clearbooks\Labs\Segment\Gateway;


class EmptySegmentProviderDummy implements SegmentProvider
{

    public function getSegments()
    {
        return [];
    }
}