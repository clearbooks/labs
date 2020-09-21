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
use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseResponse;
use PHPUnit\Framework\TestCase;

class EditReleaseTest extends TestCase
{
    /**
     * @var SpyReleaseGateway
     */
    private $gateway;

    /**
     * @var EditRelease
     */
    private $editRelease;

    private function assertFailingEditRelease( EditReleaseResponse $response, $errors )
    {
        $this->assertfalse( $response->isSuccessful() );
        $this->assertEquals( $errors, $response->getValidationErrors() );
    }

    public function setUp(): void
    {
        $this->gateway = new SpyReleaseGateway();
        $this->editRelease = new EditRelease( $this->gateway );
    }

    /**
     * @test
     */
    public function givenEmptyRequest_ResponseFailsAndReturnsAllInvalidParameterErrors()
    {
        $this->assertFailingEditRelease( $this->editRelease->execute( new EditRequestDummy ),
            [ EditReleaseResponse::INVALID_ID_ERROR, EditReleaseResponse::INVALID_NAME_ERROR, EditReleaseResponse::INVALID_URL_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvalidId_ResponseFailsAndReturnsInvalidIdError()
    {
        $this->assertFailingEditRelease( $this->editRelease->execute( new EditRequestMock( "", "test", "url" ) ),
            [ EditReleaseResponse::INVALID_ID_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvaliName_ResponseFailsAndReturnsInvalidNameError()
    {
        $this->assertFailingEditRelease( $this->editRelease->execute( new EditRequestMock( "1", null, "url" ) ),
            [ EditReleaseResponse::INVALID_NAME_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenInvaliUrl_ResponseFailsAndReturnsInvalUrlNameError()
    {
        $this->assertFailingEditRelease( $this->editRelease->execute( new EditRequestMock( "1", "test", false ) ),
            [ EditReleaseResponse::INVALID_URL_ERROR ]
        );

    }

    /**
     * @test
     */
    public function givenNonExistentId_ResponseFailsAndReturnsIdNotFoundError()
    {
        $this->assertFailingEditRelease( $this->editRelease->execute( new EditRequestMock( "1", "test", "blah" ) ),
            [ EditReleaseResponse::ID_NOT_FOUND ]
        );

    }

    /**
     * @test
     */
    public function givenValidParameters_ResponsePassesAndReturnsSuccessfulResponse()
    {
        $releaseId = $this->gateway->addRelease( "test", "blah" );
        $response = $this->editRelease->execute( new EditRequestMock( $releaseId, "test", "blah" ) );
        $this->assertTrue( $response->isSuccessful() );
    }
}
