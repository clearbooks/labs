<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Gateway\GetUserTogglesVisibleWithoutReleaseGateway;
use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;

class GetUserTogglesVisibleWithoutRelease implements UseCase\GetUserTogglesVisibleWithoutRelease
{
    /**
     * @var GetUserTogglesVisibleWithoutReleaseGateway
     */
    private $getTogglesVisibleWithoutReleaseGateway;

    /**
     * @param GetUserTogglesVisibleWithoutReleaseGateway $getTogglesVisibleWithoutReleaseGateway
     */
    public function __construct( GetUserTogglesVisibleWithoutReleaseGateway $getTogglesVisibleWithoutReleaseGateway )
    {
        $this->getTogglesVisibleWithoutReleaseGateway = $getTogglesVisibleWithoutReleaseGateway;
    }

    /**
     * @return GetTogglesVisibleWithoutReleaseResponse
     */
    public function execute()
    {
        $toggles = $this->getTogglesVisibleWithoutReleaseGateway->getUserTogglesVisibleWithoutRelease();
        return new GetTogglesVisibleWithoutReleaseResponse( $toggles );
    }
}
