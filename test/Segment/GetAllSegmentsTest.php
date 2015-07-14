<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\Gateway\EmptySegmentProviderDummy;
use Clearbooks\Labs\Segment\Gateway\SegmentProvider;
use Clearbooks\Labs\Segment\Gateway\OneSegmentSegmentProviderStub;
use Clearbooks\Labs\Segment\UseCase\GetAllSegments\ResponseSegment;

class GetAllSegmentsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $segmentName
     * @param $segmentProvider
     */
    private function assertSegmentNameIs($segmentName, $segmentProvider) {
        $segments = $this->getSegments($segmentProvider);
        /* @var $segment ResponseSegment */
        $segment = array_pop($segments);
        $this->assertEquals($segmentName, $segment->getName());
    }

    /**
     * @param $segmentProvider
     * @return ResponseSegment[]
     */
    private function getSegments( SegmentProvider $segmentProvider )
    {
        return (new GetAllSegments($segmentProvider))->execute()->getSegments();
    }

    /**
     * @test
     */
    public function GivenNoSegments_ThenReturnNoSegments() {
        $this->assertEquals( [], $this->getSegments( new EmptySegmentProviderDummy ));
    }

    /**
     * @test
     */
    public function GivenOneSegment_ThenReturnOneElement() {
        $this->assertCount( 1, $this->getSegments(new OneSegmentSegmentProviderStub));
    }

    /**
     * @test
     */
    public function GivenOneSegmentWithANullName_ThenReturnAnEmptyStringName() {
        $this->assertSegmentNameIs('', new OneSegmentSegmentProviderStub);
    }

    /**
     * @test
     */
    public function GivenOneSegmentWithAStringName_ThenReturnThatName() {
        $segmentName = 'Segment Name';
        $segmentProvider = (new OneSegmentSegmentProviderStub)
            ->withSegmentName($segmentName);
        $this->assertSegmentNameIs( $segmentName, $segmentProvider );
    }

}