<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 14:49
 */

namespace Clearbooks\Labs\Release\EditRelease;


use Clearbooks\Labs\Release\UseCase\EditRelease\EditReleaseRequest;

class EditRequestDummy implements EditReleaseRequest
{

    /**
     * @return string
     */
    public function getReleaseId()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getReleaseName()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getReleaseInfoUrl()
    {
        return "";
    }
}