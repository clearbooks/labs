<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


interface Response
{
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