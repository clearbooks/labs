<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 13:32
 */

namespace Clearbooks\Labs\Toggle\UseCase\CreateToggle;


interface ToggleResponse
{
    const INVALID_NAME_ERROR = 23;
    const INVALID_TYPE_ERROR = 24;
    const INVALID_VISIBILITY_ERROR = 25;
    const INVALID_RELEASE_ID_ERROR = 26;
    const RELEASE_NOT_FOUND_ERROR = 27;

    /**
     * @return bool
     */
    public function isSuccessful();

    /**
     * @return string[]
     */
    public function getValidationErrors();

    /**
     * @return string
     */
    public function getToggleId();
}