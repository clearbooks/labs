<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\Gateway\SegmentProvider;
use Clearbooks\Labs\Segment\GetAllSegments\ResponseSegment;
use Clearbooks\Labs\Segment\UseCase\GetAllSegments\Response;
use Clearbooks\Labs\Segment\Entity\Segment as SegmentInterface;

class GetAllSegments implements Response, UseCase\GetAllSegments
{
    /**
     * @var SegmentProvider
     */
    private $segmentProvider;

    /**
     * @param SegmentProvider $segmentProvider
     */
    public function __construct( SegmentProvider $segmentProvider ) {
        $this->segmentProvider = $segmentProvider;
    }

    /**
     * @return Response
     */
    public function execute() {
        return $this;
    }

    public function getSegments() {
        $segments = $this->segmentProvider->getSegments();

        $return = [];
        foreach ( $segments as $segment ) {
            $return[] = new ResponseSegment( $segment->getId(), $this->getName( $segment ) );
        }

        return $return;
    }

    /**
     * @param SegmentInterface $segment
     * @return string
     */
    private function getName( SegmentInterface $segment )
    {
        return $segment->getName() ?: '';
    }
}