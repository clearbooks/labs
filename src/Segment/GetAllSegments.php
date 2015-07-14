<?php
namespace Clearbooks\Labs\Segment;

use Clearbooks\Labs\Segment\Gateway\SegmentProvider;
use Clearbooks\Labs\Segment\GetAllSegments\ResponseSegment;
use Clearbooks\Labs\Segment\UseCase\GetAllSegments\Response;

class GetAllSegments implements Response
{
    /**
     * @var SegmentProvider
     */
    private $segmentProvider;

    /**
     * @param SegmentProvider $segmentProvider
     */
    public function __construct( SegmentProvider $segmentProvider )
    {
        $this->segmentProvider = $segmentProvider;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        return $this;
    }

    public function getSegments()
    {
        $return = [];
        $segments = $this->segmentProvider->getSegments();

        foreach( $segments as $segment ) {
            $return[] = new ResponseSegment( $segment->getName() );
        }

        return $return;
    }
}