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

    /**
     * @param ToggleResponse $response
     * @param string[] $errors
     */
    private function assertFailingCreateToggle( ToggleResponse $response, $errors )
    {
        $this->assertFalse( $response->isSuccessful() );
        $this->assertEquals( $errors, $response->getValidationErrors() );
    }

    /**
     * @param ToggleResponse $response
     */
    private function assertPassingCreateToggle( ToggleResponse $response )
    {
        $this->assertTrue( $response->isSuccessful() );
        $this->assertEmpty( $response->getValidationErrors() );
        $this->assertNotEmpty( $response->getToggleId() );
    }

    public function setUp()
    {
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
            ->execute( new ToggleRequestMock( "", "", null, "" ) ),
            [ ToggleResponse::INVALID_NAME_ERROR, ToggleResponse::INVALID_RELEASE_ID_ERROR, ToggleResponse::INVALID_VISIBILITY_ERROR, ToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyName_ResponseFailsAndReturnsInvalidNameError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( null, "group", false, "1" ) ),
            [ ToggleResponse::INVALID_NAME_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidType_ResponseFailsAndReturnsInvalidTypeError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( "test", "this_is_not_one_of_the_toggle_types", false, "2" ) ),
            [ ToggleResponse::INVALID_TYPE_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenInvalidVisibility_ResponseFailsAndReturnsInvalidVisibilityError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( "test", "simple", "anything_but_bool_will_fail", "3" ) ),
            [ ToggleResponse::INVALID_VISIBILITY_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenEmptyReleaseId_ResponseFailsAndReturnsInvalidReleaseError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( "test", "simple", true, null ) ),
            [ ToggleResponse::INVALID_RELEASE_ID_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenCompleteRequest_butWithNotExistentReleaseId_ResponseFailsAndReturnsReleaseNotFoundError()
    {
        $this->assertFailingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( "test", "simple", false, "4" ) ),
            [ ToggleResponse::RELEASE_NOT_FOUND_ERROR ]
        );
    }

    /**
     * @test
     */
    public function givenCompleteRequest_andWithExistentReleaseId_returnsPassedResponseWithToggleId()
    {
        $this->assertPassingCreateToggle( $this->createToggle
            ->execute( new ToggleRequestMock( "test", "simple", false, "1" ) )
        );
    }
}
