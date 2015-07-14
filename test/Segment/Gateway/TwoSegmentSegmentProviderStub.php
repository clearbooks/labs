<?php


namespace Clearbooks\Labs\Segment\Gateway;


use Clearbooks\Labs\Segment\Segment;

class TwoSegmentSegmentProviderStub implements SegmentProvider
{

    /**
     * @return Segment[]
     */
    public function getSegments()
    {
        return [ new Segment( 'seg-1', ''), new Segment( 'seg-2', '') ];
    }
}