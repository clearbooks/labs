<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 21/07/15
 */

namespace Clearbooks\Labs\Release;


class ReleaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Release $release
     */
    private $release;

    const RELEASE_NAME = 'name';
    const RELEASE_URL = 'url';

    public function setUp()
    {
        parent::setUp();

        $this->release = new Release( self::RELEASE_NAME , self::RELEASE_URL );
    }

    /**
     * @test
     */
    public function givenRelease_getReleaseNameReturnsName()
    {
        $this->assertEquals( self::RELEASE_NAME, $this->release->getReleaseName() );
    }

    /**
     * @test
     */
    public function givenRelease_GetReleaseInforUrlReturnsUrl()
    {
        $this->assertEquals( self::RELEASE_URL, $this->release->getReleaseInfoUrl() );
    }
}
//EOF ReleaseTest.php