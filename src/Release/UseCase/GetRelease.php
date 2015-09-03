<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 03/09/15
 * Time: 12:02
 */
namespace Clearbooks\Labs\Release\UseCase;

use Clearbooks\Labs\Release\Release;

interface GetRelease
{
    /**
     * @param string $id
     * @return Release|int
     */
    public function execute( $id );
}