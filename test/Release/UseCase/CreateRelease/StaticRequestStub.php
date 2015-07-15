<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 15/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


class StaticRequestStub implements Request
{

    const NAME = 'Barry Chuckle';

    const URL = 'http://secure.clearbooks.co.uk/community';


    public function getReleaseName()
    {
        return self::NAME;
    }

    public function getReleaseInfoUrl()
    {
        return self::URL;
    }
}
//EOF StaticRequestStub.php