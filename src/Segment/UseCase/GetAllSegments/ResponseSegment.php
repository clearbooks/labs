<?php


namespace Clearbooks\Labs\Segment\UseCase\GetAllSegments;


interface ResponseSegment
{

    /** @return string */
    public function getName();

    /** @return string */
    public function getId();
}