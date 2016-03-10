<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Client\Toggle\UseCase\CanDefaultToggleStatusBeOverruled;
use Clearbooks\Labs\Client\Toggle\UseCase\ToggleChecker;
use Clearbooks\Labs\Toggle\Entity\ToggleStatus;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGateway;
use Clearbooks\Labs\Toggle\Object\GetAllToggleStatusRequest;
use Clearbooks\Labs\Toggle\Object\ToggleStatusHolder;

class GetAllToggleStatus implements UseCase\GetAllToggleStatus
{
    /**
     * @var GetAllTogglesGateway
     */
    private $getAllTogglesGateway;

    /**
     * @var ToggleChecker
     */
    private $toggleChecker;

    /**
     * @var CanDefaultToggleStatusBeOverruled
     */
    private $canDefaultToggleStatusBeOverruled;

    /**
     * @param GetAllTogglesGateway $getAllTogglesGateway
     * @param ToggleChecker $toggleChecker
     * @param CanDefaultToggleStatusBeOverruled $canDefaultToggleStatusBeOverruled
     */
    public function __construct( GetAllTogglesGateway $getAllTogglesGateway, ToggleChecker $toggleChecker,
                                 CanDefaultToggleStatusBeOverruled $canDefaultToggleStatusBeOverruled )
    {

        $this->getAllTogglesGateway = $getAllTogglesGateway;
        $this->toggleChecker = $toggleChecker;
        $this->canDefaultToggleStatusBeOverruled = $canDefaultToggleStatusBeOverruled;
    }

    /**
     * @param GetAllToggleStatusRequest $request
     * @return ToggleStatus[]
     */
    public function execute( GetAllToggleStatusRequest $request )
    {
        $toggleStatusList = [ ];

        $toggles = $this->getAllTogglesGateway->getAllToggles();
        foreach ( $toggles as $toggle ) {
            $isActive = $this->toggleChecker->isToggleActive(
                    $toggle->getName(),
                    $request->getUser(),
                    $request->getGroup(),
                    $request->getSegments()
            );

            $isLocked = !$this->canDefaultToggleStatusBeOverruled->canBeOverruled(
                    $toggle->getName(),
                    $request->getSegments()
            );

            $toggleStatusList[] = new ToggleStatusHolder( $toggle->getId(), $isActive, $isLocked );
        }

        return $toggleStatusList;
    }
}
