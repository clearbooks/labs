<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Response;

class UserToggleActivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserToggleActivator
     */
    private $userToggleActivator;

    public function setUp()
    {
        $this->userToggleActivator = new UserToggleActivator( new SuccessfulUserToggleService() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleActivationRequest_ResponseHandlerReceivesResponse() {
        $request = new Request( "test_toggle", 1 );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $this->userToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertNotNull( $userToggleActivatorResponseHandlerSpy->getLastHandledResponse() );
    }

    /**
     * @test
     */
    public function WhenExecutingUserToggleActivationRequestWithoutToggleId_ResultsInUnknownIdentifierError() {
        $request = new Request( "", 1 );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $this->userToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_TOGGLE ], $userToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingUserToggleActivationRequestWithoutUserId_ResultsInUnknownUserError() {
        $request = new Request( "test_toggle", null );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $this->userToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_USER ], $userToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleActivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $this->userToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $userToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidUserToggleActivationRequest_ResponseContainsTheProperUserToggleID() {
        $request = new Request( "test_toggle", 1 );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $this->userToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $userToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
    }

    /**
     * @test
     */
    public function GivenUserToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidUserToggleActivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingUserToggleActivator = new UserToggleActivator( new FailingUserToggleService() );
        $userToggleActivatorResponseHandlerSpy = new UserToggleActivatorResponseHandlerSpy();
        $failingUserToggleActivator->execute( $request, $userToggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $userToggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF UserToggleActivatorTest.php
