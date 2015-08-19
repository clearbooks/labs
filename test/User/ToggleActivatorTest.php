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

    public function setUp()
    {
        $this->toggleActivator = new ToggleActivator( new SuccessfulToggleService() );
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
    public function WhenExecutingValidToggleActivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEmpty( $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResponseContainsTheProperToggleIDAndUserID() {
        $request = new Request( "test_toggle", 1 );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $this->toggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( $request->getToggleIdentifier(), $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getToggleIdentifier() );
        $this->assertEquals( $request->getUserIdentifier(), $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getUserIdentifier() );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidToggleActivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingToggleActivator = new ToggleActivator( new FailingToggleService() );
        $toggleActivatorResponseHandlerSpy = new ToggleActivatorResponseHandlerSpy();
        $failingToggleActivator->execute( $request, $toggleActivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $toggleActivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF ToggleActivatorTest.php
