<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 17/09/2015
 * Time: 12:50
 */

namespace Clearbooks\Labs\Response;


use Clearbooks\Labs\Response\UseCase\Response;

abstract class ValidatedResponseModel implements Response
{
    /**
     * @var bool
     */
    private $successful;

    /**
     * @var string[]
     */
    private $errors;

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->successful;
    }

    /**
     * @return string[]
     */
    public function getValidationErrors()
    {
        return $this->errors;
    }

    /**
     * @param boolean $successful
     */
    public function setSuccess( $successful )
    {
        $this->successful = $successful;
    }

    /**
     * @param string[] $errors
     */
    public function setErrors( $errors )
    {
        $this->errors = $errors;
    }
}