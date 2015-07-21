<?php
namespace Clearbooks\Labs\Segment\UseCase\GetAllSegments;

interface Response {
    /** @return ResponseSegment[] */
    public function getSegments();
}