<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\GroupToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\GroupToggleActivator\Response;

class GroupToggleActivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GroupToggleActivator
     */
    private $groupToggleActivator;

    public function setUp()
    {
        parent::setUp();
        $this->groupToggleActivator = new GroupToggleActivator( new SuccessfulGroupToggleService() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequest_ResponseHandlerReceivesResponse() {
        $request = new Request( "test_toggle", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertNotNull( $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingGroupToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $request = new Request( "", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingGroupToggleActivationRequestWithoutGroupId_ResultsInUnknownGroupError() {
        $request = new Request( "test_toggle", null, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_GROUP ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingGroupToggleActivationRequestWithoutUserId_ResultsInUnknownUserError() {
        $request = new Request( "test_toggle", 1, null );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequest_ResponseContainsTheProperGroupToggleIDAndGroupIDAndUserID() {
        $request = new Request( "test_toggle", 1, 2 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getGroupIdentifier(), $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getGroupIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
    }

    /**
     * @test
     */
    public function GivenGroupToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidGroupToggleActivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1, 1 );
        $failingGroupToggleActivator = new GroupToggleActivator( new FailingGroupToggleService() );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $failingGroupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF GroupToggleActivatorTest.php
