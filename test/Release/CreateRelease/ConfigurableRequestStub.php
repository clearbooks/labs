<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\CreateRelease;


use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseRequest;

class ConfigurableRequestStub implements CreateReleaseRequest
{
    private $name;
    private $url;

    /**
     * Construct this ConfigurableRequestStub.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param $name
     * @param $url
     */
    public function __construct( $name = null, $url = null )
    {

        $this->name = $name;
        $this->url = $url;
    }

    public function getReleaseName()
    {
        return $this->name;
    }

    public function getReleaseInfoUrl()
    {
        return $this->url;
    }


}
//EOF ConfigurableRequestStub.php