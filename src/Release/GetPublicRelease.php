<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 14:46
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\ReleaseGateway;

class GetPublicRelease
{
    private $gateway;
    /**
     * @var \DateTime
     */
    private $currentDate;

    /**
     * GetPublicRelease constructor.
     * @param ReleaseGateway $gateway
     * @param \DateTime $currentDate
     */
    public function __construct( ReleaseGateway $gateway, \DateTime $currentDate )
    {
        $this->gateway = $gateway;
        $this->currentDate = $currentDate;
    }

    /**
     * If release is visible or if its time has come/passed make it visible.
     * @return array
     */
    public function execute()
    {

        $releases = $this->gateway->getAllReleases();
        $publicReleases = [ ];

        foreach ( $releases as $release ) {
            $this->forceVisibilityOnRelease( $release );
            if ( $release->isVisible() ) {
                $publicReleases [] = $release;
            }
        }

        return $publicReleases;
    }

    /**
     * @param $release
     */
    private function forceVisibilityOnRelease( Release $release )
    {
        if ( !$release->isVisible() && $release->getReleaseDate() < $this->currentDate ) {
            $release->setVisible( true );
        }
    }
}