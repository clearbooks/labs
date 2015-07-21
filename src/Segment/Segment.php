<?php


namespace Clearbooks\Labs\Segment;


class Segment implements \Clearbooks\Labs\Segment\Entity\Segment {

    private $segmentName;
    private $segmentId;

    /**
     * @param $segmentId
     * @param $segmentName
     */
    public function __construct( $segmentId, $segmentName ) {
        $this->segmentName = $segmentName;
        $this->segmentId = $segmentId;
    }

    public function getName() {
        return $this->segmentName;
    }

    public function getId() {
        return $this->segmentId;
    }
}