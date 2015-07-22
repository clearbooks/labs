<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleActivator\Request;

class ToggleActivatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ToggleActivator
     */
    private $toggleActivator;

    public function setUp()
    {
        $this->toggleActivator = new ToggleActivator( new MockToggleService() );
    }

    /**
     * @test
     */
    public function WhenExecutingToggleActivationRequestWithoutId_ResultsInUnknownIdentifierError() {
        $request = new Request( "" );
        $this->toggleActivator->execute( $request, new UnknownIdentifierErrorExpectingToggleActivatorResponseHandler( $this ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResultsInSuccessfulResponse() {
        $request = new Request( "test_toggle" );
        $this->toggleActivator->execute( $request, new SuccessExpectingToggleActivatorResponseHandler( $this ) );
    }

    /**
     * @test
     */
    public function WhenExecutingValidToggleActivationRequest_ResponseContainsTheProperToggleID() {
        $request = new Request( "test_toggle" );
        $this->toggleActivator->execute( $request, new IDCheckingToggleActivatorResponseHandler( $this,
                                                                                                 $request->getToggleIdentifier() ) );
    }

    /**
     * @test
     */
    public function GivenToggleServiceIsNotAbleToActivateToggles_WhenExecutingValidToggleActivationRequest_ResultsInUnknownError() {
        $request = new Request( "test_toggle" );
        $failingToggleActivator = new ToggleActivator( new FailingToggleService() );
        $failingToggleActivator->execute( $request, new UnknownErrorExpectingToggleActivatorResponseHandler( $this ) );
    }
}
//EOF ToggleActivatorTest.php
