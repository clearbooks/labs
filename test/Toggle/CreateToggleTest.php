<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:18
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\CreateToggle\ToggleRequestMock;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGatewaySpy;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleResponse;

class CreateToggleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CreateToggleGateway
     */
    private $gateway;

    /**
     * @var CreateToggle
     */
    private $createToggle;


    private function assertFailingEditRelease( ToggleResponse $response, $errors )
    {
        $this->assertfalse( $response->isSuccessful() );
        $this->assertEquals( $errors, $response->getValidationErrors() );
    }

    public function setUp()
    {
        $this->gateway = new CreateToggleGatewaySpy();
        $this->createToggle = new CreateToggle( $this->gateway );
    }

    /**
     * @test
     */
    public function givenEmptyRequest_ResponseFailsAndReturnsAllInvalidParameterErrors()
    {
        $this->assertFailingEditRelease( $this->createToggle->execute( new ToggleRequestMock( "", "", null, "" ) ),
            [ ToggleResponse::INVALID_NAME_ERROR, ToggleResponse::INVALID_RELEASE_ID_ERROR, ToggleResponse::INVALID_VISIBILITY_ERROR, ToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyName_ResponseFailsAndReturnsInvalidNameErrors()
    {
        $this->assertFailingEditRelease( $this->createToggle->execute( new ToggleRequestMock( null, "simple", false, "1" ) ),
            [ ToggleResponse::INVALID_NAME_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidType_ResponseFailsAndReturnsInvalidTypeErrors()
    {
        $this->assertFailingEditRelease( $this->createToggle->execute( new ToggleRequestMock( "test", "", false, "1" ) ),
            [ ToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidVisibility_ResponseFailsAndReturnsInvalidVisibilityErrors()
    {
        $this->assertFailingEditRelease( $this->createToggle->execute( new ToggleRequestMock( "test", "simple", null, "1" ) ),
            [ ToggleResponse::INVALID_VISIBILITY_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyRelease_ResponseFailsAndReturnsInvalidReleaseErrors()
    {
        $this->assertFailingEditRelease( $this->createToggle->execute( new ToggleRequestMock( "test", "simple", false, null ) ),
            [ ToggleResponse::INVALID_RELEASE_ID_ERROR ]
        );
    }
}
