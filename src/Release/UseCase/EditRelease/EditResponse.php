<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 13:59
 */

namespace Clearbooks\Labs\Release\UseCase\EditRelease;


interface EditResponse
{
    const INVALID_ID_ERROR = 19;
    const INVALID_NAME_ERROR = 20;
    const INVALID_URL_ERROR = 21;
    const ID_NOT_FOUND = 22;

    /**
     * @return bool
     */
    public function isSuccessful();

    /**
     * @return string[]
     */
    public function getValidationErrors();
}