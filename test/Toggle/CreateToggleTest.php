<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:18
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\CreateToggle\CreateToggleRequestMock;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\CreateToggleGatewaySpy;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleResponse;
use PHPUnit\Framework\TestCase;

class CreateToggleTest extends TestCase
{
    /**
     * @var CreateToggleGateway
     */
    private $gateway;

    /**
     * @var CreateToggle
     */
    private $createToggle;

    /**
     * @param CreateToggleResponse $response
     * @param string[] $errors
     */
    private function assertFailingCreateToggle( CreateToggleResponse $response, $errors )
    {
        $this->assertFalse( $response->isSuccessful() );
        $this->assertEquals( $errors, $response->getValidationErrors() );
    }

    /**
     * @param CreateToggleResponse $response
     */
    private function assertPassingCreateToggle( CreateToggleResponse $response )
    {
        $this->assertTrue( $response->isSuccessful() );
        $this->assertEmpty( $response->getValidationErrors() );
        $this->assertNotEmpty( $response->getToggleId() );
    }

    public function setUp(): void
    {
        parent::setUp();
        $existentReleaseIds = [ 1, 2, 3 ];
        $this->gateway = new CreateToggleGatewaySpy( $existentReleaseIds );
        $this->createToggle = new CreateToggle( $this->gateway );
    }

    /**
     * @test
     */
    public function givenEmptyRequest_ResponseFailsAndReturnsAllInvalidParameterErrors()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "", "", null, "" ) ), [
                CreateToggleResponse::INVALID_NAME_ERROR, CreateToggleResponse::INVALID_RELEASE_ID_ERROR,
                CreateToggleResponse::INVALID_VISIBILITY_ERROR, CreateToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyName_ResponseFailsAndReturnsInvalidNameError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( null, "group", false, "1" ) ),
            [ CreateToggleResponse::INVALID_NAME_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidType_ResponseFailsAndReturnsInvalidTypeError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "test", "this_is_not_one_of_the_toggle_types", false, "2" ) ),
            [ CreateToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidVisibility_ResponseFailsAndReturnsInvalidVisibilityError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "test", "simple", "anything_but_bool_will_fail", "3" ) ),
            [ CreateToggleResponse::INVALID_VISIBILITY_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyReleaseId_ResponseFailsAndReturnsInvalidReleaseError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "test", "simple", true, null ) ),
            [ CreateToggleResponse::INVALID_RELEASE_ID_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenCompleteRequest_butWithNotExistentReleaseId_ResponseFailsAndReturnsReleaseNotFoundError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "test", "simple", false, "4" ) ),
            [ CreateToggleResponse::RELEASE_NOT_FOUND_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenCompleteRequest_andWithExistentReleaseId_returnsPassedResponseWithToggleId()
    {
        $this->assertPassingCreateToggle( $this->createToggle
            ->execute( new CreateToggleRequestMock( "test", "simple", false, "1" ) )
        );
    }
}
