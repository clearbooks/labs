<?php
namespace Clearbooks\Labs\Segment\Entity;

interface Segment {
    /** @return string */
    public function getName();

    /** @return string */
    public function getId();
}