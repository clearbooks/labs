<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\ToggleActivator\Response;

class ToggleActivatorResponseHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function WhenCallingToggleActivatorResponseHandler_CodeRunsWithoutException() {
        $responseHandler = new ToggleActivatorResponseHandler();
        $responseHandler->handleResponse( new Response() );
    }
}
//EOF ToggleActivatorResponseHandlerTest.php
