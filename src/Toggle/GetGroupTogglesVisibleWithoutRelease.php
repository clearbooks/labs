<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Gateway\GetGroupTogglesVisibleWithoutReleaseGateway;
use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;

class GetGroupTogglesVisibleWithoutRelease implements UseCase\GetGroupTogglesVisibleWithoutRelease
{
    /**
     * @var GetGroupTogglesVisibleWithoutReleaseGateway
     */
    private $getTogglesVisibleWithoutReleaseGateway;

    /**
     * @param GetGroupTogglesVisibleWithoutReleaseGateway $getTogglesVisibleWithoutReleaseGateway
     */
    public function __construct( GetGroupTogglesVisibleWithoutReleaseGateway $getTogglesVisibleWithoutReleaseGateway )
    {
        $this->getTogglesVisibleWithoutReleaseGateway = $getTogglesVisibleWithoutReleaseGateway;
    }

    /**
     * @return GetTogglesVisibleWithoutReleaseResponse
     */
    public function execute()
    {
        $toggles = $this->getTogglesVisibleWithoutReleaseGateway->getGroupTogglesVisibleWithoutRelease();
        return new GetTogglesVisibleWithoutReleaseResponse( $toggles );
    }
}
