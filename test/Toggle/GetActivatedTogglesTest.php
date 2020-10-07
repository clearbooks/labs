<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 10:31
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\GroupStub;
use Clearbooks\Labs\Client\Toggle\Entity\Segment;
use Clearbooks\Labs\Client\Toggle\Entity\SegmentStub;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\Entity\UserStub;
use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\Parasol;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayDummy;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayStub;
use Clearbooks\Labs\Toggle\Object\GetActivatedTogglesRequest;
use PHPUnit\Framework\TestCase;

class GetActivatedTogglesTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Group
     */
    private $group;

    /**
     * @var Segment[]
     */
    private $segments;

    /**
     * @var GetActivatedTogglesRequest
     */
    private $testRequest;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new UserStub("1");
        $this->group = new GroupStub("1");
        $this->segments = [ new SegmentStub( "1", 10 ) ];
        $this->testRequest = new GetActivatedTogglesRequest( $this->user, $this->group, $this->segments );
    }

    /**
     * @test
     */
    public function givenNoActivatedToggles_GetActivatedToggles_ReturnsEmptyArray()
    {
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayDummy, new FailingToggleCheckerStub))->execute( $this->testRequest );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenOneActivatedToggle_getActivatedToggles_ReturnsActivatedToggleroo()
    {
        $expectedToggles = [ new Brolly ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $expectedToggles ), new PassingToggleCheckerStub ) )->execute( $this->testRequest );
        $this->assertEquals( $expectedToggles, $response );
    }

    /**
     * @test
     */
    public function givenOneInactivatedToggle_getActivatedToggles_ReturnsEmptyArray()
    {
        $expectedToggles = [ new Brolly ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $expectedToggles ), new FailingToggleCheckerStub ) )->execute( $this->testRequest );
        $this->assertEquals( [], $response );
    }

    /**
     * @test
     */
    public function givenOneActiveAndOneInactivatedToggle_getActivatedToggles_ReturnsOnlyActiveToggleArray()
    {
        $toggles = [ new Brolly, new Parasol ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $toggles ), new OnlyBrolliesToggleChecker($toggles) ) )->execute( $this->testRequest );
        $this->assertEquals( [new Brolly()], $response );
    }

    /**
     * @test
     */
    public function givenOneActiveToggle_getActivatedToggles_PassesCorrectInformationToToggleChecker()
    {
        $brolly = new Brolly;
        $spy = new ToggleCheckerSpy();

        ( new GetActivatedToggles( new GetAllTogglesGatewayStub( [ $brolly ] ), $spy ) )->execute( $this->testRequest );

        $this->assertEquals( $brolly->getName(), $spy->getToggleName() );
        $this->assertEquals( $this->user, $spy->getUser() );
        $this->assertEquals( $this->group, $spy->getGroup() );
        $this->assertEquals( $this->segments, $spy->getSegments() );
    }
}
