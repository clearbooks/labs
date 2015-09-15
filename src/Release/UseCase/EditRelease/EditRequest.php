<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 13:57
 */

namespace Clearbooks\Labs\Release\UseCase\EditRelease;


interface EditRequest
{
    /**
     * @return string
     */
    public function getReleaseId();

    /**
     * @return string
     */
    public function getReleaseName();

    /**
     * @return string
     */
    public function getReleaseInfoUrl();
}