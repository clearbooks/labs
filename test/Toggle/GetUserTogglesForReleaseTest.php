<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 03/08/2015
 * Time: 14:51
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Release\Gateway\VisibleStubReleaseGateway;
use Clearbooks\Labs\Toggle\Entity\UserToggleStub;
use Clearbooks\Labs\Toggle\Gateway\UserToggleGatewayStub;

class GetUserTogglesForReleaseTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }

    /**
     * @test
     */
    public function givenNoAvailableUserToggles_GetUserTogglesReturnsEmptyArray()
    {
        $response = $this->getUserTogglesForRelease( new UserToggleGatewayStub( [ ] ),
            new VisibleStubReleaseGateway(), 1 );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenAvailableToggles_GetUserTogglesReturnsArrayOfToggles()
    {
        $availableToggle = new UserToggleStub( 1 );
        $response = $this->getUserTogglesForRelease( new UserToggleGatewayStub( [ $availableToggle ] ),
            new VisibleStubReleaseGateway(),
            $availableToggle->getRelease() );
        $this->assertEquals( [ $availableToggle ], $response );
    }

    /**
     * @test
     */
    public function givenTogglesWithDifferentReleases_GetUserTogglesReturnsArrayOfToggles_ForSpecificRelease()
    {
        $availableToggle = new UserToggleStub( 1 );
        $unavailableToggle = new UserToggleStub( 2 );
        $response = $this->getUserTogglesForRelease( new UserToggleGatewayStub( [ $availableToggle, $unavailableToggle ] ),
            new VisibleStubReleaseGateway(),
            $availableToggle->getRelease() );
        $this->assertEquals( [ $availableToggle ], $response );
    }

    /**
     * @test
     */
    public function givenInvisibleRelease_GetUserTogglesReturnsEmptyArray()
    {
        $unavailableToggle = new UserToggleStub( 1 );
        $response = $this->getUserTogglesForRelease( new UserToggleGatewayStub( [ $unavailableToggle ] ),
            new VisibleStubReleaseGateway( false ), $unavailableToggle->getRelease() );
        $this->assertEquals( [ ], $response );
    }


    public function getUserTogglesForRelease( $gateway, $releaseGateway, $releaseId )
    {
        return ( new GetUserTogglesForRelease( $gateway, $releaseGateway ) )->execute( $releaseId );
    }
}
