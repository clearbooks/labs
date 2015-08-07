<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 11:15
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\ReleaseGateway;

class GetRelease
{
    const INVALID_ID_ERROR = 21;
    const NO_RELEASE_FOUND = 22;
    /**
     * @var ReleaseGateway
     */
    private $gateway;

    /**
     * GetRelease constructor.
     */
    public function __construct( ReleaseGateway $gateway )
    {

        $this->gateway = $gateway;
    }

    /**
     * @param string $id
     * @return Release|int
     */
    public function execute( $id )
    {
        if ( empty( $id ) ) {
            return $this::INVALID_ID_ERROR;
        }
        $release = $this->gateway->getRelease( $id );
        if ( empty( $release ) ) {
            return $this::NO_RELEASE_FOUND;
        }
        return $release;
    }
}