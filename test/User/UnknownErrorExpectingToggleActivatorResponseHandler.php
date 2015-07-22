<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class UnknownErrorExpectingToggleActivatorResponseHandler implements ToggleActivatorResponseHandler
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
        $this->asserter->assertEquals( [ Response::ERROR_UNKNOWN_ERROR ], $response->getErrors() );
    }
}
//EOF UnknownErrorExpectingToggleActivatorResponseHandler.php
