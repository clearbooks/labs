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
    const RELEASE_IS_VISIBLE = true;

    public function setUp()
    {
        parent::setUp();

        $this->release = new Release( self::RELEASE_NAME, self::RELEASE_URL, self::RELEASE_IS_VISIBLE );
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
    public function givenRelease_GetReleaseInfoUrlReturnsUrl()
    {
        $this->assertEquals( self::RELEASE_URL, $this->release->getReleaseInfoUrl() );
    }

    public function givenRelease_GetReleaseIsVisibleReturnsUrl()
    {
        $this->assertEquals( self::RELEASE_IS_VISIBLE, $this->release->isIsVisible() );
    }
}
//EOF ReleaseTest.php