<?php
namespace Clearbooks\Labs\Segment\GetAllSegments;

use Clearbooks\Labs\Segment\UseCase\GetAllSegments\ResponseSegment as IResponseSegment;

class ResponseSegment implements IResponseSegment {
    /**
     * @var
     */
    private $segmentName;
    /**
     * @var
     */
    private $segmentId;

    /**
     * ResponseSegment constructor.
     * @param $segmentId
     * @param $segmentName
     */
    public function __construct( $segmentId, $segmentName ) {
        $this->segmentName = $segmentName;
        $this->segmentId = $segmentId;
    }

    /** @return string */
    public function getName() {
        return $this->segmentName;
    }

    /** @return string */
    public function getId() {
        return $this->segmentId;
    }
}