<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 04/08/2015
 * Time: 15:52
 */

namespace Clearbooks\Labs\Toggle\Entity;


class UserToggleStub implements UserToggle
{
    /**
     * @var string
     */
    private $releaseId;

    /**
     * UserToggleStub constructor.
     * @param string $releaseId
     */
    public function __construct( $releaseId )
    {
        $this->releaseId = $releaseId;
    }

    /**
     * @return string
     */
    public function getRelease()
    {
        return $this->releaseId;
    }
}