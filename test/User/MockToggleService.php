<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleService;

class MockToggleService implements ToggleService
{
    /**
     * @var array
     */
    private $toggleStatus = [ ];

    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier )
    {
        $this->toggleStatus[$toggleIdentifier] = true;
        return true;
    }
}
//EOF MockToggleService.php
