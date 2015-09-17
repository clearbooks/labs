<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\CreateRelease\ConfigurableRequestStub;
use Clearbooks\Labs\Release\Gateway\SpyReleaseGateway;
use Clearbooks\Labs\Release\CreateRelease\StaticRequestStub;
use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseRequest;
use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseResponse;

class CreateReleaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var SpyReleaseGateway
     */
    private $releaseGateway;

    /**
     * @var CreateRelease
     */
    private $createRelease;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->releaseGateway = new SpyReleaseGateway();
        $this->createRelease = new CreateRelease( $this->releaseGateway );
    }


    /**
     * @test
     */
    public function givenEmptyRequest_ReturnsNotSuccessfulAndGetBothInvalidArgumentsError()
    {
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub() ),
            array( CreateReleaseResponse::INVALID_NAME_ERROR, CreateReleaseResponse::INVALID_URL_ERROR ) );
    }

    /**
     * @test
     */
    public function givenInvalidName_ReturnsNotSuccessfulAndGetInvalidNameError()
    {
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub( null,
            'some url' ) ), array( CreateReleaseResponse::INVALID_NAME_ERROR ) );
    }

    /**
     * @test
     */
    public function givenInvalidUrl_ReturnsNotSuccessfulAndGetInvalidUrlError()
    {
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub( 'Release One',
            null ) ), array( CreateReleaseResponse::INVALID_URL_ERROR ) );
    }

    /**
     * @test
     */
    public function givenNameAndUrl_ReturnsSuccessfulAndReleaseCreatedAndNoErrors()
    {
        $request = new StaticRequestStub();
        $response = $this->createRelease( $request );
        $this->assertNotEmpty( $response->getReleaseId() );
        $this->assertTrue( $response->isSuccessful() );
        $this->assertEmpty( $response->getValidationErrors() );
        $this->assertEquals( 1, $this->releaseGateway->getTimesAddReleaseCalled() );
        $release = $this->releaseGateway->getAddReleaseParams()[ 0 ];
        $this->assertEquals( $request->getReleaseName(), $release[ 'releaseName' ] );
        $this->assertEquals( $request->getReleaseInfoUrl(), $release[ 'url' ] );
    }

    private function createRelease( CreateReleaseRequest $request )
    {
        return $this->createRelease->execute( $request );
    }

    /**
     * @param CreateReleaseResponse $response
     * @param array $expectedErrors
     */
    private function assertCreateReleaseWasUnsuccessful( CreateReleaseResponse $response, $expectedErrors = array() )
    {
        $this->assertFalse( $response->isSuccessful() );
        $this->assertEquals( $expectedErrors, $response->getValidationErrors() );
    }
}
//EOF CreateReleaseTest.php