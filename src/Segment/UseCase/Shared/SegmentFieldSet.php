<?php


namespace Clearbooks\Labs\Segment\UseCase\Shared;


interface SegmentFieldSet
{

    /** @return string */
    public function getName();

    /** @return string */
    public function getId();
}