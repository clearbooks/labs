<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\CreateRelease\ConfigurableRequestStub;
use Clearbooks\Labs\Release\Gateway\SpyReleaseGateway;
use Clearbooks\Labs\Release\CreateRelease\StaticRequestStub;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Response;

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
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub() ), array( Response::INVALID_NAME_ERROR, Response::INVALID_URL_ERROR ) );
    }

    /**
     * @test
     */
    public function givenInvalidName_ReturnsNotSuccessfulAndGetInvalidNameError()
    {
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub( null, 'some url' ) ), array( Response::INVALID_NAME_ERROR ) );
    }

    /**
     * @test
     */
    public function givenInvalidUrl_ReturnsNotSuccessfulAndGetInvalidUrlError()
    {
        $this->assertCreateReleaseWasUnsuccessful( $this->createRelease( new ConfigurableRequestStub( 'Release One', null ) ), array( Response::INVALID_URL_ERROR ) );
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
        $release = $this->releaseGateway->getAddReleaseParams()[0];
        $this->assertEquals( $request->getReleaseName(), $release['releaseName'] );
        $this->assertEquals( $request->getReleaseInfoUrl(), $release['url'] );
    }

    private function createRelease( Request $request )
    {
        return $this->createRelease->execute( $request );
    }

    /**
     * @param Response $response
     * @param array $expectedErrors
     */
    private function assertCreateReleaseWasUnsuccessful( Response $response, $expectedErrors = array() )
    {
        $this->assertFalse( $response->isSuccessful() );
        $this->assertEquals( $expectedErrors, $response->getValidationErrors() );
    }
}
//EOF CreateReleaseTest.php