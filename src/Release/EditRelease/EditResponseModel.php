<?php
namespace Clearbooks\Labs\Release\EditRelease;

use Clearbooks\Labs\Release\UseCase\EditRelease\EditResponse;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 15/09/2015
 * Time: 14:31
 */
class EditResponseModel implements EditResponse
{
    /**
     * @var bool
     */
    private $success;

    /**
     * @var string[]
     */
    private $errors;

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->success;
    }

    /**
     * @return string[]
     */
    public function getValidationErrors()
    {
        return $this->errors;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess( $success )
    {
        $this->success = $success;
    }

    /**
     * @param string[] $errors
     */
    public function setErrors( $errors )
    {
        $this->errors = $errors;
    }
}