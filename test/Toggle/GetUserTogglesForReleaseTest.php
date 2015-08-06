<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 03/08/2015
 * Time: 14:51
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Release\Gateway\ConfigurableVisibilityReleaseGatewayMock;
use Clearbooks\Labs\Toggle\Entity\UserToggleStub;
use Clearbooks\Labs\Toggle\Gateway\UserToggleGatewayStub;

class GetUserTogglesForReleaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function givenNoAvailableUserToggles_GetUserTogglesReturnsEmptyArray()
    {
        $response = $this->getUserTogglesForRelease( [ ], 1 );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenInvisibleRelease_GetUserTogglesReturnsEmptyArray()
    {
        $unavailableToggle = new UserToggleStub( 1 );
        $response = $this->getUserTogglesForRelease( [ $unavailableToggle ], $unavailableToggle->getRelease(), false );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenAvailableUserToggles_InTheVisibleRelease_GetUserTogglesReturnsArrayOfToggles()
    {
        $availableToggle = new UserToggleStub( 1 );
        $response = $this->getUserTogglesForRelease( [ $availableToggle ],
            $availableToggle->getRelease() );
        $this->assertEquals( [ $availableToggle ], $response );
    }

    /**
     * @test
     */
    public function givenUserTogglesWithDifferentReleases_GetUserTogglesReturnsArrayOfToggles_ForSpecificRelease()
    {
        $availableToggle = new UserToggleStub( 1 );
        $unavailableToggle = new UserToggleStub( 2 );
        $response = $this->getUserTogglesForRelease( [ $availableToggle, $unavailableToggle ],
            $availableToggle->getRelease() );
        $this->assertEquals( [ $availableToggle ], $response );
    }

    /**
     * @param $arrayOfToggles
     * @param $releaseId
     * @param bool|true $visibilityFlag
     * @return Entity\UserToggle[]
     */
    public function getUserTogglesForRelease( $arrayOfToggles, $releaseId, $visibilityFlag = true )
    {
        $gateway = new UserToggleGatewayStub( $arrayOfToggles );
        $releaseGateway = new ConfigurableVisibilityReleaseGatewayMock( $visibilityFlag );
        return ( new GetUserTogglesForRelease( $gateway, $releaseGateway ) )->execute( $releaseId );
    }
}
