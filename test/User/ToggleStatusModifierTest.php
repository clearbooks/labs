<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;
use PHPUnit\Framework\TestCase;

class ToggleStatusModifierTest extends TestCase
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

    public function setUp(): void
    {
        parent::setUp();

        $this->successfulToggleStatusModifierServiceSpy = new SuccessfulToggleStatusModifierServiceSpy();
        $this->permissionService = new MockPermissionService();

        $this->toggleStatusModifier = new ToggleStatusModifier( $this->successfulToggleStatusModifierServiceSpy,
                                                                new ToggleStatusModifierRequestValidator( $this->permissionService ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_GetResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );

        $this->assertNotNull( $this->toggleStatusModifier->execute( $request ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleDeactivationRequest_ResponseHandlerReceivesResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_INACTIVE, 1 );

        $this->assertNotNull( $this->toggleStatusModifier->execute( $request ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleUnsetRequest_ResponseHandlerReceivesResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_UNSET, 1 );

        $this->assertNotNull( $this->toggleStatusModifier->execute( $request ) );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleStatusModifierRequestWithInvalidState_ResultIsInvalidToggleStatusError()
    {
        $request = new Request( "test_toggle", "non-existing toggle status", 1 );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( [ Response::ERROR_INVALID_TOGGLE_STATUS ], $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError()
    {
        $request = new Request( "", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ],
                             $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutUserId_ResultsInUnknownUserError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, null );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ],
                             $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithInvalidGroupId_ResultsInUnknownGroupError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1, -1 );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_GROUP ],
                             $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResultsInSuccessfulResponse()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEmpty( $response->getErrors() );
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
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEmpty( $response->getErrors() );
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
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( $request->getToggleIdentifier(),
                             $response->getToggleIdentifier() );
        $this->assertEquals( $request->getNewToggleStatus(),
                             $response->getNewToggleStatus() );
        $this->assertEquals( $request->getUserIdentifier(),
                             $response->getUserIdentifier() );
        $this->assertEquals( $request->getGroupIdentifier(),
                             $response->getGroupIdentifier() );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidToggleActivationRequest_ResultsInUnknownError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $failingToggleActivator = new ToggleStatusModifier( new FailingToggleStatusModifierService(),
                                                            new ToggleStatusModifierRequestValidator( $this->permissionService ) );
        $response = $failingToggleActivator->execute( $request );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ],
                             $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidGroupToggleActivationRequestWithNonGroupAdminUser_ResultsInUserIsNotGroupAdminError()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1, 1 );
        $response = $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( [ Response::ERROR_USER_IS_NOT_GROUP_ADMIN ],
                             $response->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_SetToggleStatusForUserIsCalled()
    {
        $request = new Request( "test_toggle", ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, 1 );
        $this->toggleStatusModifier->execute( $request );

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
        $this->toggleStatusModifier->execute( $request );

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
        $this->toggleStatusModifier->execute( $request );

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
        $this->toggleStatusModifier->execute( $request );

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
        $this->toggleStatusModifier->execute( $request );

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
        $this->toggleStatusModifier->execute( $request );

        $this->assertEquals( ToggleStatusModifier::TOGGLE_STATUS_UNSET,
                             $this->successfulToggleStatusModifierServiceSpy->getToggleStatusForGroup( $request->getToggleIdentifier(),
                                                                                                       $request->getGroupIdentifier() ) );
    }
}
//EOF ToggleStatusModifierTest.php
