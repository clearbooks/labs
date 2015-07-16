<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


interface Response
{
    const INVALID_NAME_ERROR = 'Invalid Argument, the release must have a non empty string for a release name';
    const INVALID_URL_ERROR = 'Invalid Argument, the release must have a non empty string for an info URL';

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