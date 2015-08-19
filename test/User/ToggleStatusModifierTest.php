<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;

class ToggleStatusModifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ToggleStatusModifier
     */
    private $toggleStatusModifier;

    /**
     * @var SuccessfulToggleStatusModifierServiceSpy
     */
    private $successfulToggleStatusModifierServiceSpy;

    /**
     * @var MockPermissionService
     */
    private $permissionService;

    public function setUp()
    {
        parent::setUp();

        $this->successfulToggleStatusModifierServiceSpy = new SuccessfulToggleStatusModifierServiceSpy();
        $this->permissionService = new MockPermissionService();

        $this->toggleStatusModifier = new ToggleStatusModifier( $this->successfulToggleStatusModifierServiceSpy,
                                                                $this->permissionService );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResponseHandlerReceivesResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertNotNull( $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeactivationRequest_ResponseHandlerReceivesResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_INACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertNotNull( $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleUnsetRequest_ResponseHandlerReceivesResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_UNSET, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertNotNull( $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleStatusModifierRequestWithInvalidState_ResultIsInvalidToggleStatusError()
    {
        $request = new Request( "test_toggle", "non-existing toggle status", 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_INVALID_TOGGLE_STATUS ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError()
    {
        $request = new Request( "", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutUserId_ResultsInUnknownUserError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, null );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithInvalidGroupId_ResultsInUnknownGroupError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1, -1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_GROUP ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResultsInSuccessfulResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEmpty( $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleActivationRequestWithGroupId_ResultsInSuccessfulResponse()
    {
        $userIdentifier = 1;
        $groupIdentifier = 1;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, $userIdentifier, $groupIdentifier );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEmpty( $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleActivationRequestWithGroupId_ResponseContainsRequestParameters()
    {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, $userIdentifier, $groupIdentifier );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(),
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getNewToggleStatus(),
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getNewToggleStatus() );
        $this->assertEquals( $request->getUserIdentifier(),
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
        $this->assertEquals( $request->getGroupIdentifier(),
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getGroupIdentifier() );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidToggleActivationRequest_ResultsInUnknownError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $failingToggleActivator = new ToggleStatusModifier( new FailingToggleStatusModifierService(),
                                                            $this->permissionService );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $failingToggleActivator->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequestWithNonGroupAdminUser_ResultsInUserIsNotGroupAdminError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_USER_IS_NOT_GROUP_ADMIN ],
                             $toggleStatusModifierResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_SetToggleStatusForUserIsCalled()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_ACTIVE,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForUser( $request->getToggleIdentifier(),
                                                                                                      $request->getUserIdentifier() ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeActivationRequest_DeActivateToggleForUserIsCalled()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_INACTIVE, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_INACTIVE,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForUser( $request->getToggleIdentifier(),
                                                                                                      $request->getUserIdentifier() ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleUnsetRequest_UnsetToggleForUserIsCalled()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_UNSET, 1 );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_UNSET,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForUser( $request->getToggleIdentifier(),
                                                                                                      $request->getUserIdentifier() ) );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleActivationRequestWithGroup_ActivateToggleForGroupIsCalled()
    {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, $userIdentifier, $groupIdentifier );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_ACTIVE,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForGroup( $request->getToggleIdentifier(),
                                                                                                       $request->getGroupIdentifier() ) );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleDeActivationRequestWithGroup_DeActivateToggleForGroupIsCalled()
    {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_INACTIVE, $userIdentifier, $groupIdentifier );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_INACTIVE,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForGroup( $request->getToggleIdentifier(),
                                                                                                       $request->getGroupIdentifier() ) );
    }

    /**
     * @test
     */
    public function GivenUserIsGroupAdmin_WhenExecutingValidToggleUnsetRequestWithGroup_UnsetToggleForGroupIsCalled()
    {
        $userIdentifier = 1;
        $groupIdentifier = 2;

        $this->permissionService->addAsGroupAdmin( $userIdentifier, $groupIdentifier );

        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_UNSET, $userIdentifier, $groupIdentifier );
        $toggleStatusModifierResponseHandlerSpy = new ToggleStatusModifierResponseHandlerSpy();
        $this->toggleStatusModifier->execute( $request, $toggleStatusModifierResponseHandlerSpy );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_UNSET,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForGroup( $request->getToggleIdentifier(),
                                                                                                       $request->getGroupIdentifier() ) );
    }
}
//EOF ToggleStatusModifierTest.php
