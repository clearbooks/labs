<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\InMemoryReleaseGateway;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\UseCase\CreateRelease\BlankRequestStub;
use Clearbooks\Labs\Release\UseCase\CreateRelease\StaticRequestStub;

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
        $this->assertFalse( $this->createRelease->execute( new BlankRequestStub() ) );
    }

    /**
     * @test
     */
    public function givenNameAndUrl_ReturnsTrueReleaseCreated()
    {
        $request = new StaticRequestStub();
        $releaseId = $this->createRelease->execute( $request );
        $release = $this->releaseGateway->getRelease( $releaseId );
        $this->assertEquals( $request->getReleaseName(), $release->getReleaseName() );
        $this->assertEquals( $request->getReleaseInfoUrl(), $release->getReleaseInfoUrl() );
    }
}
//EOF CreateReleaseTest.php