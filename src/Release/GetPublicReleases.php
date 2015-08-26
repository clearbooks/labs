<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 14:46
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\PublicReleaseGateway;
use Clearbooks\Labs\Release\UseCase\GetPublicRelease\PublicRelease;

class GetPublicRelease
{
    /**
     * @var PublicReleaseGateway
     */
    private $gateway;

    /**
     * GetPublicRelease constructor.
     * @param PublicReleaseGateway $gateway
     */
    public function __construct( PublicReleaseGateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * If release is visible or if its time has come/passed make it visible.
     * @return PublicRelease[]
     */
    public function execute()
    {
        return $this->gateway->getAllPublicReleases();
    }
}