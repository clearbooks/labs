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

    /**
     * @var MockPermissionService
     */
    private $permissionService;

    public function setUp()
    {
        parent::setUp();
        $this->permissionService = new MockPermissionService();
        $this->groupToggleActivator = new GroupToggleActivator( new SuccessfulGroupToggleService(),
                                                                $this->permissionService );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequest_ResponseHandlerReceivesResponse() {
        $this->permissionService->addAsGroupAdmin( 1, 1 );

        $request = new Request( "test_toggle", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertNotNull( $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingGroupToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $this->permissionService->addAsGroupAdmin( 1, 1 );

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
        $this->permissionService->addAsGroupAdmin( 1, 1 );

        $request = new Request( "test_toggle", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequest_ResponseContainsTheProperGroupToggleIDAndGroupIDAndUserID() {
        $this->permissionService->addAsGroupAdmin( 1, 2 );

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
        $this->permissionService->addAsGroupAdmin( 1, 1 );

        $request = new Request( "test_toggle", 1, 1 );
        $failingGroupToggleActivator = new GroupToggleActivator( new FailingGroupToggleService(), $this->permissionService );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $failingGroupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequestWithNonGroupAdminUser_ResultsInUserIsNotGroupAdminError() {
        $this->permissionService->clearGroupAdminData();

        $request = new Request( "test_toggle", 1, 1 );
        $groupToggleActivatorResponseHandlerSpy = new GroupToggleActivatorResponseHandlerSpy();
        $this->groupToggleActivator->execute( $request, $groupToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_USER_IS_NOT_GROUP_ADMIN ], $groupToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF GroupToggleActivatorTest.php
