<?php
namespace Clearbooks\Labs\Toggle\Object;

use PHPUnit\Framework\TestCase;

class ToggleStatusHolderTest extends TestCase
{
    /**
     * @test
     */
    public function WhenConstructingObject_ExpectRightValuesReturnedByGetters()
    {
        $id = "1";
        $active = true;
        $locked = true;
        $toggleStatusHolder = new ToggleStatusHolder( $id, $active, $locked );
        $this->assertEquals( $id, $toggleStatusHolder->getId() );
        $this->assertEquals( $active, $toggleStatusHolder->isActive() );
        $this->assertEquals( $locked, $toggleStatusHolder->isLocked() );
    }
}
