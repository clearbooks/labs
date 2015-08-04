<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleDeactivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleDeactivator\Response;

class UserToggleDeactivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserToggleDeactivator
     */
    private $userToggleDeactivator;

    public function setUp()
    {
        $this->userToggleDeactivator = new UserToggleDeactivator( new SuccessfulUserToggleService() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleDeactivationRequest_ResponseHandlerReceivesResponse() {
        $request = new Request( "test_toggle", 1 );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $this->userToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertNotNull( $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingUserToggleDeactivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $request = new Request( "", 1 );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $this->userToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ], $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingUserToggleDeactivationRequestWithoutUserId_ResultsInUnknownUserError() {
        $request = new Request( "test_toggle", null );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $this->userToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ], $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleDeactivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $this->userToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertEmpty( $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleDeactivationRequest_ResponseContainsTheProperUserToggleIDAndUserID() {
        $request = new Request( "test_toggle", 1 );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $this->userToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
    }

    /**
     * @test
     */
    public function GivenUserToggleServiceIsNotAbleToDeactivateToggles_WhenExecutingValidUserToggleDeactivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingUserToggleDeactivator = new UserToggleDeactivator( new FailingUserToggleService() );
        $userToggleDeactivatorResponseHandlerSpy = new UserToggleDeactivatorResponseHandlerSpy();
        $failingUserToggleDeactivator->execute( $request, $userToggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $userToggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF UserToggleDeactivatorTest.php
