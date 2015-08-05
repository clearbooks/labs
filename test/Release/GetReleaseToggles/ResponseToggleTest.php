<?php
namespace Clearbooks\Labs\Release\GetReleaseToggles;

class ResponseToggleTest extends \PHPUnit_Framework_TestCase
{
    const NAME = 'name';

    /**
     * @test
     */
    public function GivenToggleName_WhenGetName_ThenReturnsName()
    {
        $this->assertEquals( self::NAME, ( new ResponseToggle( self::NAME ) )->getName() );
    }
}