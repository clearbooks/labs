<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifierService;

class SuccessfulToggleStatusModifierServiceSpy implements ToggleStatusModifierService
{
    /**
     * @var array
     */
    private $userToggleStatuses = [ ];

    /**
     * @var array
     */
    private $groupToggleStatuses = [ ];

    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $userIdentifier
     * @return bool
     */
    public function setToggleStatusForUser( $toggleIdentifier, $toggleStatus, $userIdentifier )
    {
        if ( !isset( $this->userToggleStatuses[$toggleIdentifier] ) ) {
            $this->userToggleStatuses[$toggleIdentifier] = [ ];
        }

        $this->userToggleStatuses[$toggleIdentifier][$userIdentifier] = $toggleStatus;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $groupIdentifier
     * @param int    $actingUserIdentifier
     * @return bool
     */
    public function setToggleStatusForGroup( $toggleIdentifier, $toggleStatus, $groupIdentifier, $actingUserIdentifier )
    {
        if ( !isset( $this->groupToggleStatuses[$toggleIdentifier] ) ) {
            $this->groupToggleStatuses[$toggleIdentifier] = [ ];
        }

        $this->groupToggleStatuses[$toggleIdentifier][$groupIdentifier] = $toggleStatus;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return string
     */
    public function getToggleStatusForUser( $toggleIdentifier, $userIdentifier )
    {
        if ( !isset( $this->userToggleStatuses[$toggleIdentifier] )
                || !isset( $this->userToggleStatuses[$toggleIdentifier][$userIdentifier] ) ) {

            return ToggleStatusModifier::TOGGLE_STATUS_UNSET;
        }

        return $this->userToggleStatuses[$toggleIdentifier][$userIdentifier];
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @return string
     */
    public function getToggleStatusForGroup( $toggleIdentifier, $groupIdentifier )
    {
        if ( !isset( $this->groupToggleStatuses[$toggleIdentifier] )
                || !isset( $this->groupToggleStatuses[$toggleIdentifier][$groupIdentifier] ) ) {

            return ToggleStatusModifier::TOGGLE_STATUS_UNSET;
        }

        return $this->groupToggleStatuses[$toggleIdentifier][$groupIdentifier];
    }
}
//EOF SuccessfulToggleStatusModifierServiceSpy.php
