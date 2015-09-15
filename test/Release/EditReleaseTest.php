<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 14:01
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\EditRelease\EditRequestDummy;
use Clearbooks\Labs\Release\EditRelease\EditRequestMock;
use Clearbooks\Labs\Release\Gateway\SpyReleaseGateway;
use Clearbooks\Labs\Release\EditRelease;
use Clearbooks\Labs\Release\UseCase\EditRelease\EditResponse;
use PHPUnit_Framework_TestCase;

class EditReleaseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SpyReleaseGateway
     */
    private $gateway;

    /**
     * @var EditRelease
     */
    private $editRelease;

    private function assertFailingEditRelease( EditResponse $response, $errors )
    {
        $this->assertfalse( $response->isSuccessful() );
        $this->assertEquals( $errors, $response->getValidationErrors() );
    }

    public function setUp()
    {
        $this->gateway = new SpyReleaseGateway();
        $this->editRelease = new EditRelease( $this->gateway );
    }

    /**
     * @test
     */
    public function givenEmptyRequest_ResponseFailsAndReturnsAllInvalidParameterErrors()
    {
        $this->assertFailingEditRelease( $this->editRelease->exacute( new EditRequestDummy ),
            [ EditResponse::INVALID_ID_ERROR, EditResponse::INVALID_NAME_ERROR, EditResponse::INVALID_URL_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvalidId_ResponseFailsAndReturnsInvalidIdError()
    {
        $this->assertFailingEditRelease( $this->editRelease->exacute( new EditRequestMock( "", "test", "url" ) ),
            [ EditResponse::INVALID_ID_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvaliName_ResponseFailsAndReturnsInvalidNameError()
    {
        $this->assertFailingEditRelease( $this->editRelease->exacute( new EditRequestMock( "1", null, "url" ) ),
            [ EditResponse::INVALID_NAME_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvaliUrl_ResponseFailsAndReturnsInvalUrlNameError()
    {
        $this->assertFailingEditRelease( $this->editRelease->exacute( new EditRequestMock( "1", "test", false ) ),
            [ EditResponse::INVALID_URL_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenNonExistentId_ResponseFailsAndReturnsIdNotFoundError()
    {
        $this->assertFailingEditRelease( $this->editRelease->exacute( new EditRequestMock( "1", "test", "blah" ) ),
            [ EditResponse::ID_NOT_FOUND ]
        );

    }

    /**
     * @test
     */
    public function givenValidParameters_ResponsePassesAndReturnsSuccessfulResponse()
    {
        $releaseId = $this->gateway->addRelease( "test", "blah" );
        $response = $this->editRelease->exacute( new EditRequestMock( $releaseId, "test", "blah" ) );
        $this->assertTrue( $response->isSuccessful() );
    }
}
