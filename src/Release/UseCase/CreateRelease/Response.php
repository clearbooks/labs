<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


interface Response
{
    const INVALID_NAME_ERROR = 11;
    const INVALID_URL_ERROR = 12;

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
    public function getReleaseId();
}
//EOF Response.php