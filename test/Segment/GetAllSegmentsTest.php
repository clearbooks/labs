<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\Gateway\SegmentProvider;
use Clearbooks\Labs\Segment\Gateway\OneSegmentSegmentProviderStub;

class GetAllSegmentsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $segmentProvider
     * @return mixed
     */
    private function getSegments( SegmentProvider $segmentProvider)
    {
        return (new GetAllSegments($segmentProvider))->execute()->getSegments();
    }

    /**
     * @test
     */
    public function GivenNoSegments_ThenReturnNoSegments() {
        $this->assertEquals( [], $this->getSegments( new OneSegmentSegmentProviderStub ));
    }

    /**
     * @test
     */
    public function GivenOneSegment_ThenReturnOneElement() {
        $this->assertCount( 1, $this->getSegments(new OneSegmentSegmentProviderStub));
    }

}