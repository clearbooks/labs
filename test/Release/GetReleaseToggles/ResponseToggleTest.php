<?php
namespace Clearbooks\Labs\Release\GetReleaseToggles;

use PHPUnit\Framework\TestCase;

class ResponseToggleTest extends TestCase
{
    const NAME = 'name';
    const ID = 'id';
    const DESC = 'description';
    const URL = 'http://example.com';

    /**
     * @test
     */
    public function GivenToggleName_WhenGetName_ThenReturnsName()
    {
        $this->assertEquals( self::NAME, ( new ResponseToggle( null, self::NAME, null, null ) )->getName() );
    }

    /**
     * @test
     */
    public function givenToggleId_WhenGetId_IdReturnedIsCorrect()
    {
        $this->assertEquals( self::ID, ( new ResponseToggle( self::ID, null, null, null ) )->getId() );
    }

    /**
     * @test
     */
    public function givenToggleDescription_WhenGetDescription_ReturnsCorrectDescription()
    {
        $this->assertEquals( self::DESC, ( new ResponseToggle( null, null, self::DESC, null ) )->getDescription() );
    }

    /**
     * @test
     */
    public function givenGuideUrl_WhenGetGuideUrl_ReturnsGuideUrl()
    {
        $this->assertEquals( self::URL, ( new ResponseToggle( null, null, self::DESC, self::URL ) )->getUrl() );
    }
}
