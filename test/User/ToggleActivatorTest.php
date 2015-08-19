<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;

class ToggleActivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ToggleActivator
     */
    private $toggleActivator;

    /**
     * @var MockPermissionService
     */
    private $permissionService;

    public function setUp()
    {
        parent::setUp();
        $this->permissionService = new MockPermissionService();
        $this->toggleActivator = new ToggleActivator( new SuccessfulToggleService(), $this->permissionService );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResponseHandlerReceivesResponse() {
        $request = new Request( "test_toggle", 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertNotNull( $toggleActivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $request = new Request( "", 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutUserId_ResultsInUnknownUserError() {
        $request = new Request( "test_toggle", null );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithInvalidGroupId_ResultsInUnknownGroupError() {
        $request = new Request( "test_toggle", 1, -1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_GROUP ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleActivationRequestWithGroupId_ResultsInSuccessfulResponse() {
        $userIdentifier = 1;
        $groupIdentifier = 1;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", $userIdentifier, $groupIdentifier );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResponseContainsTheProperToggleIDAndUserIDAndGroupID() {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", $userIdentifier, $groupIdentifier );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
        $this->assertEquals( $request->getGroupIdentifier(), $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getGroupIdentifier() );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidToggleActivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingToggleActivator = new ToggleActivator( new FailingToggleService(), $this->permissionService );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $failingToggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequestWithNonGroupAdminUser_ResultsInUserIsNotGroupAdminError() {
        $request = new Request( "test_toggle", 1, 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_USER_IS_NOT_GROUP_ADMIN ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF ToggleActivatorTest.php
