<?php
namespace Clearbooks\Labs\Segment;

class GetSegment implements \Clearbooks\Labs\Segment\UseCase\GetSegment
{
    /**
     * @var UseCase\GetAllSegments
     */
    private $getAllSegments;

    /**
     * @param UseCase\GetAllSegments $getAllSegments
     */
    public function __construct( UseCase\GetAllSegments $getAllSegments )
    {
        $this->getAllSegments = $getAllSegments;
    }

    public function execute($segmentId)
    {
        $response = $this->getAllSegments->execute();
        foreach( $response->getSegments() as $segment ) {
            if( $segment->getId() == $segmentId ) {
                return $segment;
            }
        }
        return null;
    }
}