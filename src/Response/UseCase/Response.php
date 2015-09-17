<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 17/09/2015
 * Time: 12:53
 */

namespace Clearbooks\Labs\Response\UseCase;


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
     * @param boolean $successful
     */
    public function setSuccess( $successful );

    /**
     * @param string[] $errors
     */
    public function setErrors( $errors );
}