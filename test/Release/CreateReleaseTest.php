<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\InMemoryReleaseGateway;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\CreateRelease\BlankRequestStub;
use Clearbooks\Labs\Release\CreateRelease\StaticRequestStub;
use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;

class CreateReleaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ReleaseGateway
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

        $this->releaseGateway = new InMemoryReleaseGateway();
        $this->createRelease = new CreateRelease( $this->releaseGateway );
    }


    /**
     * @test
     */
    public function givenEmptyRequest_ReturnsFalse()
    {
        $response =  $this->createRelease( new BlankRequestStub() );
        $this->assertFalse( $response->isSuccessful() );
        $this->assertCount( 1, $response->getValidationErrors() );
    }

    /**
     * @test
     */
    public function givenNameAndUrl_ReturnsTrueReleaseCreated()
    {
        $request = new StaticRequestStub();
        $response = $this->createRelease( $request );
        $this->assertNotEmpty( $response->getReleaseId() );
        $release = $this->releaseGateway->getRelease( $response->getReleaseId() );
        $this->assertTrue( $response->isSuccessful() );
        $this->assertEmpty( $response->getValidationErrors() );
        $this->assertEquals( $request->getReleaseName(), $release->getReleaseName() );
        $this->assertEquals( $request->getReleaseInfoUrl(), $release->getReleaseInfoUrl() );
    }

    private function createRelease( Request $request )
    {
        return $this->createRelease->execute( $request );
    }
}
//EOF CreateReleaseTest.php