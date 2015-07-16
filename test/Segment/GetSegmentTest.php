<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\UseCase\GetSegment\Response;

class GetSegmentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param $segmentId
     * @param $segmentProvider
     * @return Response
     */
    private function getSegment($segmentId, $segmentProvider)
    {
        return (new GetSegment(new GetAllSegments($segmentProvider)))->execute($segmentId);
    }

    /**
     * @param $segmentId
     */
    private function assertNoSegmentReturned($segmentId)
    {
        $this->assertNull($this->getSegment($segmentId, new Gateway\EmptySegmentProviderDummy));
    }

    /**
     * @test
     */
    public function GivenInvalidSegmentId_ReturnsNullSegment() {
        $this->assertNoSegmentReturned('');
    }

    /**
     * @test
     */
    public function GivenNonExistentSegmentId_ReturnsNullSegment() {
        $this->assertNoSegmentReturned('seg-404');
    }

    /**
     * @test
     */
    public function GivenSegmentExists_ReturnsNotNull() {
        $this->assertNotNull($this->getSegment('seg-1', new Gateway\OneSegmentSegmentProviderStub));
    }

    /**
     * @test
     */
    public function GivenSegmentExists_SegmentReturnedHasSameId() {
        $this->assertEquals( 'seg-1', $this->getSegment( 'seg-1', new Gateway\OneSegmentSegmentProviderStub )->getId() );
    }
}