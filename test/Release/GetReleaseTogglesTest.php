<?php
namespace Clearbooks\Labs\Release;

use Clearbooks\Labs\Release\GetReleaseToggles\ResponseToggle;
use Clearbooks\Labs\Toggle\Entity\BrollyToggle;

class GetReleaseTogglesTest extends \PHPUnit_Framework_TestCase
{
    const RELEASE_ID = 'some_release_identifier';

    /**
     * @param Gateway\ReleaseToggleCollection $releaseToggleCollection
     * @param string                          $releaseId
     * @return GetReleaseToggles\ResponseToggle[]
     */
    private function executeGetReleaseToggles( Gateway\ReleaseToggleCollection $releaseToggleCollection, $releaseId )
    {
        $getReleaseToggles = new GetReleaseToggles( $releaseToggleCollection );
        return $getReleaseToggles->execute( $releaseId );
    }

    /**
     * @test
     */
    public function GivenEmptyRelease_WhenGetReleaseToggles_ThenReturnsNothing()
    {
        $this->assertEmpty( $this->executeGetReleaseToggles( new Gateway\EmptyReleaseToggleCollection, null ) );
    }

    /**
     * @test
     */
    public function GivenReleaseWithToggle_WhenGetReleaseToggles_ThenReturnsToggle()
    {
        $responseToggle = $this->executeGetReleaseToggles( new Gateway\BrollyReleaseToggleCollection, self::RELEASE_ID );
        $this->assertEquals( [ new ResponseToggle( BrollyToggle::ID, BrollyToggle::NAME, BrollyToggle::DESC ) ], $responseToggle );
    }

    /**
     * @test
     */
    public function GivenReleaseId_WhenGetReleaseToggles_ThenGatewayReceivesId()
    {
        $releaseToggleCollection = new Gateway\ReleaseToggleCollectionMock;
        $this->executeGetReleaseToggles( $releaseToggleCollection, self::RELEASE_ID );
        $this->assertEquals( self::RELEASE_ID, $releaseToggleCollection->releaseId );
    }

}