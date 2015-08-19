<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleDeactivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleDeactivator\Response;

class ToggleDeactivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ToggleDeactivator
     */
    private $toggleDeactivator;

    /**
     * @var MockPermissionService
     */
    private $permissionService;

    public function setUp()
    {
        parent::setUp();
        $this->permissionService = new MockPermissionService();
        $this->toggleDeactivator = new ToggleDeactivator( new SuccessfulToggleService(), $this->permissionService );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeactivationRequest_ResponseHandlerReceivesResponse() {
        $request = new Request( "test_toggle", 1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertNotNull( $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleDeactivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $request = new Request( "", 1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleDeactivationRequestWithoutUserId_ResultsInUnknownUserError() {
        $request = new Request( "test_toggle", null );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithInvalidGroupId_ResultsInUnknownGroupError() {
        $request = new Request( "test_toggle", 1, -1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_GROUP ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeactivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEmpty( $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleDeactivationRequestWithGroupId_ResultsInSuccessfulResponse() {
        $userIdentifier = 1;
        $groupIdentifier = 1;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", $userIdentifier, $groupIdentifier );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEmpty( $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeactivationRequest_ResponseContainsTheProperToggleIDAndUserID() {
        $request = new Request( "test_toggle", 1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeativationRequest_ResponseContainsTheProperToggleIDAndUserIDAndGroupID() {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", $userIdentifier, $groupIdentifier );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
        $this->assertEquals( $request->getGroupIdentifier(), $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getGroupIdentifier() );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToDeactivateToggles_WhenExecutingValidToggleDeactivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingToggleDeactivator = new ToggleDeactivator( new FailingToggleService(), $this->permissionService );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $failingToggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleDeactivationRequestWithNonGroupAdminUser_ResultsInUserIsNotGroupAdminError() {
        $request = new Request( "test_toggle", 1, 1 );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $this->toggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_USER_IS_NOT_GROUP_ADMIN ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF ToggleDeactivatorTest.php
