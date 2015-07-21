<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class SuccessExpectingToggleActivatorResponseHandler implements ToggleActivatorResponseHandler
{
    /**
     * @var \PHPUnit_Framework_Assert
     */
    private $asserter;

    public function __construct( \PHPUnit_Framework_Assert $asserter )
    {
        $this->asserter = $asserter;
    }

    public function handleResponse( Response $response )
    {
        $this->asserter->assertTrue( empty( $response->getErrors() ) );
    }
}
//EOF SuccessExpectingToggleActivatorResponseHandler.php
