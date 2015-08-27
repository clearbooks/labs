<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 26/08/2015
 * Time: 14:34
 */

namespace Clearbooks\Labs\Release\Gateway;


use Clearbooks\Labs\Release\Entity\PublicRelease;
use DateTime;

class MockPublicReleaseGateway implements PublicReleaseGateway
{
    /**
     * @var \Clearbooks\Labs\Release\Entity\PublicRelease[]
     */
    private $releases;

    /**
     * MockPublicReleaseGateway constructor.
     * @param PublicRelease[] $releases
     */
    public function __construct( $releases )
    {
        $this->releases = $releases;
    }


    /**
     * @return PublicRelease[]
     */
    public function getAllPublicReleases()
    {
        $publicReleases = [ ];
        $currentDate = new DateTime();

        foreach ( $this->releases as $release ) {
            if ( $release->isVisible() || $release->getReleaseDate() < $currentDate ) {
                $publicReleases [] = $release;
            }
        }

        return $publicReleases;
    }
}