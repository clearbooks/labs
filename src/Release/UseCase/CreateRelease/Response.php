<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


interface Response
{
    const INVALID_ARG_ERROR = 'Invalid Arguments, release must have a non empty name and info url';

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