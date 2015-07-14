<?php
namespace Clearbooks\Labs\Segment\GetAllSegments;

class ResponseSegment implements \Clearbooks\Labs\Segment\UseCase\GetAllSegments\ResponseSegment
{
    /**
     * @var
     */
    private $segmentName;

    /**
     * ResponseSegment constructor.
     */
    public function __construct( $segmentName )
    {
        $this->segmentName = $segmentName;
    }


    /** @return string */
    public function getName()
    {
        return $this->segmentName ?: '';
    }
}