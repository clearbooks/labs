<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\Gateway\EmptySegmentProviderDummy;
use Clearbooks\Labs\Segment\Gateway\SegmentProvider;
use Clearbooks\Labs\Segment\Gateway\OneSegmentSegmentProviderStub;
use Clearbooks\Labs\Segment\Gateway\TwoSegmentSegmentProviderStub;
use Clearbooks\Labs\Segment\UseCase\GetAllSegments\ResponseSegment;

class GetAllSegmentsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $segmentName
     * @param $segmentProvider
     */
    private function assertSegmentNameIs($segmentName, $segmentProvider) {
        $segment = $this->getLastSegment($segmentProvider);
        $this->assertEquals($segmentName, $segment->getName());
    }

    /**
     * @param $expectedCount
     * @param $segmentProvider
     */
    private function assertCountOfSegmentsIs($expectedCount, $segmentProvider)
    {
        $this->assertCount($expectedCount, $this->getSegments($segmentProvider));
    }

    /**
     * @param $segmentProvider
     * @return ResponseSegment
     */
    private function getLastSegment($segmentProvider)
    {
        $segments = $this->getSegments($segmentProvider);
        /* @var $segment ResponseSegment */
        $segment = array_pop($segments);
        return $segment;
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
        $this->assertCountOfSegmentsIs(1, new OneSegmentSegmentProviderStub);
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

    /**
     * @test
     */
    public function GivenOneSegment_ThenExposesIdInResponse() {
        $this->assertEquals( 'seg-1', $this->getLastSegment( new OneSegmentSegmentProviderStub )->getId() );
    }

    /**
     * @test
     */
    public function GivenTwoSegments_ThenExposeIdsInResponse() {
        $segments = $this->getSegments( new TwoSegmentSegmentProviderStub );

        $this->assertEquals( 'seg-1', $segments[0]->getId() );
        $this->assertEquals( 'seg-2', $segments[1]->getId() );
    }

}