<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\Entity\GroupStub;
use Clearbooks\Labs\Client\Toggle\Entity\SegmentStub;
use Clearbooks\Labs\Client\Toggle\Entity\UserStub;
use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;
use Clearbooks\Labs\Toggle\Entity\Parasol;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayStub;
use Clearbooks\Labs\Toggle\Object\GetAllToggleStatusRequest;
use Clearbooks\Labs\Toggle\Object\ToggleStatusHolder;

class GetAllToggleStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GetAllTogglesGatewayStub
     */
    private $getAllTogglesGatewayStub;

    /**
     * @var NameBasedToggleCheckerMock
     */
    private $nameBasedToggleCheckerMock;

    /**
     * @var NameBasedCanDefaultToggleStatusBeOverruledMock
     */
    private $nameBasedCanDefaultToggleStatusBeOverruledMock;

    /**
     * @var GetAllToggleStatus
     */
    private $getAllToggleStatus;

    /**
     * @var ToggleCheckerSpy
     */
    private $toggleCheckerSpy;

    /**
     * @var CanDefaultToggleStatusBeOverruledSpy
     */
    private $canDefaultToggleStatusBeOverruledSpy;

    /**
     * @var GetAllToggleStatus
     */
    private $spyableGetAllToggleStatus;

    /**
     * @var GetAllToggleStatusRequest
     */
    private $getAllToggleStatusRequest;

    public function setUp()
    {
        parent::setUp();

        $this->getAllTogglesGatewayStub = new GetAllTogglesGatewayStub();
        $this->nameBasedToggleCheckerMock = new NameBasedToggleCheckerMock();
        $this->nameBasedCanDefaultToggleStatusBeOverruledMock = new NameBasedCanDefaultToggleStatusBeOverruledMock();
        $this->getAllToggleStatus = new GetAllToggleStatus(
                $this->getAllTogglesGatewayStub,
                $this->nameBasedToggleCheckerMock,
                $this->nameBasedCanDefaultToggleStatusBeOverruledMock
        );

        $this->toggleCheckerSpy = new ToggleCheckerSpy();
        $this->canDefaultToggleStatusBeOverruledSpy = new CanDefaultToggleStatusBeOverruledSpy();
        $this->spyableGetAllToggleStatus = new GetAllToggleStatus(
                $this->getAllTogglesGatewayStub,
                $this->toggleCheckerSpy,
                $this->canDefaultToggleStatusBeOverruledSpy
        );

        $this->getAllToggleStatusRequest = new GetAllToggleStatusRequest(
            new UserStub( 1 ), new GroupStub( 2 ),
            [ new SegmentStub( 1, 10 ) ]
        );
    }

    /**
     * @test
     */
    public function GivenNoToggles_ExpectEmptyArray()
    {
        $response = $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function GivenNoToggles_ExpectToggleCheckerNotCalled()
    {
        $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertNull( $this->toggleCheckerSpy->getToggleName() );
        $this->assertNull( $this->toggleCheckerSpy->getUser() );
        $this->assertNull( $this->toggleCheckerSpy->getGroup() );
        $this->assertNull( $this->toggleCheckerSpy->getSegments() );
    }

    /**
     * @test
     */
    public function GivenNoToggles_ExpectCanDefaultToggleStatusBeOverruledNotCalled()
    {
        $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertNull( $this->canDefaultToggleStatusBeOverruledSpy->getToggleName() );
        $this->assertNull( $this->canDefaultToggleStatusBeOverruledSpy->getSegments() );
    }

    /**
     * @test
     */
    public function WhenExecuting_ExpectToggleCheckerCalledWithProperValues()
    {
        $toggle = new Brolly();
        $this->getAllTogglesGatewayStub->setExpectedToggles( [ $toggle ] );
        $this->spyableGetAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertEquals( $toggle->getName(), $this->toggleCheckerSpy->getToggleName() );
        $this->assertEquals( $this->getAllToggleStatusRequest->getUser(), $this->toggleCheckerSpy->getUser() );
        $this->assertEquals( $this->getAllToggleStatusRequest->getGroup(), $this->toggleCheckerSpy->getGroup() );
        $this->assertEquals( $this->getAllToggleStatusRequest->getSegments(), $this->toggleCheckerSpy->getSegments() );
    }

    /**
     * @test
     */
    public function WhenExecuting_ExpectCanDefaultToggleStatusBeOverruledCalledWithProperValues()
    {
        $toggle = new Brolly();
        $this->getAllTogglesGatewayStub->setExpectedToggles( [ $toggle ] );
        $this->spyableGetAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertEquals( $toggle->getName(), $this->canDefaultToggleStatusBeOverruledSpy->getToggleName() );
        $this->assertEquals( $this->getAllToggleStatusRequest->getSegments(), $this->canDefaultToggleStatusBeOverruledSpy->getSegments() );
    }

    /**
     * @test
     */
    public function GivenToggles_ExpectProperStatusForAllOfThem()
    {
        /** @var MarketableToggle[] $toggles */
        $toggles = [
            new Brolly(),
            new Parasol()
        ];

        $this->getAllTogglesGatewayStub->setExpectedToggles( $toggles );
        $response = $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertEquals(
                [
                    new ToggleStatusHolder( $toggles[0]->getId(), false, false ),
                    new ToggleStatusHolder( $toggles[1]->getId(), false, false )
                ],
                $response
        );
    }

    /**
     * @test
     */
    public function GivenToggle_WhenToggleIsActive_ExpectActiveInStatus()
    {
        $toggle = new Brolly();

        $this->nameBasedToggleCheckerMock->setToggleStatus( $toggle->getName(), true );

        $this->getAllTogglesGatewayStub->setExpectedToggles( [ $toggle ] );
        $response = $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertEquals(
                [
                        new ToggleStatusHolder( $toggle->getId(), true, false )
                ],
                $response
        );
    }

    /**
     * @test
     */
    public function GivenToggle_WhenDefaultToggleStatusCannotBeOverruled_ExpectLockedInStatus()
    {
        $toggle = new Brolly();

        $this->nameBasedCanDefaultToggleStatusBeOverruledMock->setToggleCanBeOverruled( $toggle->getName(), false );

        $this->getAllTogglesGatewayStub->setExpectedToggles( [ $toggle ] );
        $response = $this->getAllToggleStatus->execute( $this->getAllToggleStatusRequest );

        $this->assertEquals(
                [
                        new ToggleStatusHolder( $toggle->getId(), false, true )
                ],
                $response
        );
    }
}
