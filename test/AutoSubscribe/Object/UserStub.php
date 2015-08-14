<?php
namespace Clearbooks\Labs\AutoSubscribe\Object;

use Clearbooks\Labs\AutoSubscribe\Entity\User;

class UserStub implements User
{
    /**
     * @var int
     */
    private $id;

    /**
     * UserStub constructor.
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
//EOF UserStub.php