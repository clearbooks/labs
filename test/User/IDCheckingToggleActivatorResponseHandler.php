<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class IDCheckingToggleActivatorResponseHandler implements ToggleActivatorResponseHandler
{
    /**
     * @var \PHPUnit_Framework_Assert
     */
    private $asserter;

    /**
     * @var string
     */
    private $toggleIdentifier;

    public function __construct( \PHPUnit_Framework_Assert $asserter, $toggleIdentifier )
    {
        $this->asserter = $asserter;
        $this->toggleIdentifier = $toggleIdentifier;
    }

    public function handleResponse( Response $response )
    {
        $this->asserter->assertEquals( $this->toggleIdentifier, $response->getToggleIdentifier() );
    }
}
//EOF IDCheckingToggleActivatorResponseHandler.php
