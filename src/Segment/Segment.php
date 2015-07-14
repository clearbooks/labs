<?php


namespace Clearbooks\Labs\Segment;


class Segment
{
    private $segmentName;


    /**
     * Segment constructor.
     */
    public function __construct( $segmentName )
    {
        $this->segmentName = $segmentName;
    }

    public function getName()
    {
        return $this->segmentName;
    }
}