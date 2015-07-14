<?php


namespace Clearbooks\Labs\Segment\Gateway;


use Clearbooks\Labs\Segment\Segment;

class OneSegmentSegmentProviderStub implements SegmentProvider
{

    private $segmentName = null;

    public function getSegments()
    {
        return [ new Segment( $this->segmentName ) ];
    }

    /**
     * @param $string
     * @return $this
     */
    public function withSegmentName($string)
    {
        $this->segmentName = $string;
        return $this;
    }
}