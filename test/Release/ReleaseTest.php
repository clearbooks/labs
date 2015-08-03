<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 21/07/15
 */

namespace Clearbooks\Labs\Release;


use DateTime;

class ReleaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Release $release
     */
    private $release;

    const RELEASE_NAME = 'name';
    const RELEASE_URL = 'url';
    const RELEASE_IS_VISIBLE = true;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->release = new Release( self::RELEASE_NAME, self::RELEASE_URL, self::getDate(),
            self::RELEASE_IS_VISIBLE );
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

    /**
     * @test
     */
    public function givenRelease_GetReleaseIsVisibleReturnsUrl()
    {
        $this->assertEquals( self::RELEASE_IS_VISIBLE, $this->release->isVisible() );
    }

    /**
     * @test
     */
    public function givenRelease_GetReleaseReleaseDateReturnsDate()
    {
        $this->assertEquals( self::getDate(), $this->release->getReleaseDate() );
    }

    /**
     * @return DateTime
     */
    private function getDate()
    {
        return DateTime::createFromFormat( 'd/m/Y', '10/07/2015' );
    }
}

//EOF ReleaseTest.php