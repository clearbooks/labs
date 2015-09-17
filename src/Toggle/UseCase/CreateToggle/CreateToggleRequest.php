<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 13:32
 */

namespace Clearbooks\Labs\Toggle\UseCase\CreateToggle;


interface CreateToggleRequest
{
    /**
     * @return string
     */
    public function getToggleName();

    /**
     * @return string
     */
    public function getToggleType();

    /**
     * @return bool
     */
    public function isToggleVisible();

    /**
     * @return string
     */
    public function getToggleReleaseId();
}