<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifierService;

class SuccessfulToggleStatusModifierServiceSpy implements ToggleStatusModifierService
{
    /**
     * @var bool
     */
    private $activateToggleForUserCalled = false;

    /**
     * @var bool
     */
    private $deActivateToggleForUserCalled = false;

    /**
     * @var bool
     */
    private $unsetToggleForUserCalled = false;

    /**
     * @var bool
     */
    private $activateToggleForGroupCalled = false;

    /**
     * @var bool
     */
    private $deActivateToggleForGroupCalled = false;

    /**
     * @var bool
     */
    private $unsetToggleForGroupCalled = false;

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        $this->activateToggleForUserCalled = true;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        $this->deActivateToggleForUserCalled = true;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function unsetToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        $this->unsetToggleForUserCalled = true;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function activateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        $this->activateToggleForGroupCalled = true;
        return true;
    }

    /**
     * @param string  $toggleIdentifier
     * @param  int    $groupIdentifier
     * @param     int $actingUserIdentifier
     * @return bool
     */
    public function deActivateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        $this->deActivateToggleForGroupCalled = true;
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param  int   $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function unsetToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        $this->unsetToggleForGroupCalled = true;
        return true;
    }

    /**
     * @return boolean
     */
    public function isActivateToggleForUserCalled()
    {
        return $this->activateToggleForUserCalled;
    }

    /**
     * @return boolean
     */
    public function isDeActivateToggleForUserCalled()
    {
        return $this->deActivateToggleForUserCalled;
    }

    /**
     * @return boolean
     */
    public function isUnsetToggleForUserCalled()
    {
        return $this->unsetToggleForUserCalled;
    }

    /**
     * @return boolean
     */
    public function isActivateToggleForGroupCalled()
    {
        return $this->activateToggleForGroupCalled;
    }

    /**
     * @return boolean
     */
    public function isDeActivateToggleForGroupCalled()
    {
        return $this->deActivateToggleForGroupCalled;
    }

    /**
     * @return boolean
     */
    public function isUnsetToggleForGroupCalled()
    {
        return $this->unsetToggleForGroupCalled;
    }
}
//EOF SuccessfulToggleStatusModifierServiceSpy.php
