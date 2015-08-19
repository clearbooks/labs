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

    public function setUp()
    {
        $this->toggleDeactivator = new ToggleDeactivator( new SuccessfulToggleService() );
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
    public function WhenExecutingValidToggleDeactivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle", 1 );
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
    public function GivenToggleServiceIsNotAbleToDeactivateToggles_WhenExecutingValidToggleDeactivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle", 1 );
        $failingToggleDeactivator = new ToggleDeactivator( new FailingToggleService() );
        $toggleDeactivatorResponseHandlerSpy = new ToggleDeactivatorResponseHandlerSpy();
        $failingToggleDeactivator->execute( $request, $toggleDeactivatorResponseHandlerSpy );

        $this->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $toggleDeactivatorResponseHandlerSpy->getLastHandledResponse()->getErrors() );
    }
}
//EOF ToggleDeactivatorTest.php
