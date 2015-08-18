<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 14:46
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\UseCase\GetPublicRelease\PublicRelease;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;

class GetPublicRelease
{
    /**
     * @var ReleaseGateway
     */
    private $gateway;
    /**
     * @var \DateTimeInterface
     */
    private $currentDate;

    /**
     * GetPublicRelease constructor.
     * @param ReleaseGateway $gateway
     * @param \DateTimeInterface $currentDate
     */
    public function __construct( ReleaseGateway $gateway, \DateTimeInterface $currentDate )
    {
        $this->gateway = $gateway;
        $this->currentDate = $currentDate;
    }

    /**
     * If release is visible or if its time has come/passed make it visible.
     * @return PublicRelease[]
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
     * @param Entity\PublicRelease $release
     */
    private function forceVisibilityOnRelease( \Clearbooks\Labs\Release\Entity\PublicRelease $release )
    {
        if ( !$release->isVisible() && $release->getReleaseDate() < $this->currentDate ) {
            $release->setVisible( true );
        }
    }
}