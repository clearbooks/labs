<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Release\Gateway\VisibleStubReleaseGateway;
use Clearbooks\Labs\Toggle\Entity\GroupToggleStub;
use Clearbooks\Labs\Toggle\Gateway\DummyGroupToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\StubGroupToggleGateway;

class GetGroupTogglesForReleaseTest extends \PHPUnit_Framework_TestCase
{

    const RELEASEID = 1;

    private function getGroupTogglesForRelease( $gateway, $releaseGateway )
    {
        return ( new GetGroupTogglesForRelease( $gateway, $releaseGateway ) )->execute( self::RELEASEID );
    }

    /**
     * @test
     */
    public function givenNoGroupTogglesInRelease_GetGroupTogglesForReleaseReturnsEmptyArray()
    {
        $toggles = $this->getGroupTogglesForRelease( new DummyGroupToggleGateway(), new VisibleStubReleaseGateway() );
        $this->assertEquals( [ ], $toggles );
    }

    /**
     * @test
     */
    public function givenReleaseNotVisible_GetGroupTogglesForReleaseReturnsEmptyArray()
    {
        $toggles = $this->getGroupTogglesForRelease( new DummyGroupToggleGateway(), new VisibleStubReleaseGateway( false ) );
        $this->assertEquals( [ ], $toggles );
    }

    /**
     * @test
     */
    public function givenVisibleRelease_AndAvailableGroupToggles_GetGroupTogglesForReleaseReturnsToggles()
    {
        $expectedToggles = [ new GroupToggleStub( self::RELEASEID ) ];
        $toggles = $this->getGroupTogglesForRelease( new StubGroupToggleGateway( $expectedToggles ), new VisibleStubReleaseGateway() );
        $this->assertEquals( $expectedToggles, $toggles );
    }

    /**
     * @test
     */
    public function givenVisibleRelease_AndAvailableGroupTogglesForDifferentReleases_ReturnsTogglesFromSpecifiedRelease()
    {
        $expectedToggles = new GroupToggleStub( self::RELEASEID );
        $unexpectedToggles = new GroupToggleStub( 2 );
        $toggles = $this->getGroupTogglesForRelease( new StubGroupToggleGateway( [ $expectedToggles, $unexpectedToggles ] ), new VisibleStubReleaseGateway() );
        $this->assertEquals( [ $expectedToggles ], $toggles );
    }
}
//EOF GetGroupTogglesForReleaseTest.php