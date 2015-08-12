<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle\Entity;


class GroupToggleStub implements GroupToggle
{
    /**
     * @var
     */
    private $releaseId;


    /**
     * @param $releaseId
     */
    function __construct( $releaseId )
    {

        $this->releaseId = $releaseId;
    }


    public function getRelease()
    {
        return $this->releaseId;
    }
}
//EOF GroupToggleStub.php