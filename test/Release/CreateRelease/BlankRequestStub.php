<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\CreateRelease;


use Clearbooks\Labs\Release\UseCase\CreateRelease\Request;

class BlankRequestStub implements Request
{
    public function getReleaseName()
    {
        return null;
    }

    public function getReleaseInfoUrl()
    {
        return null;
    }
}
//EOF BlankRequestStub.php