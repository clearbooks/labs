<?php
namespace Clearbooks\Labs\Toggle\CreateToggle;

use Clearbooks\Labs\Toggle\UseCase\CreateToggle\ToggleResponse;

/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:52
 */
class ToggleResponseModel implements ToggleResponse
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
     * @var string
     */
    private $toggleId;

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
     * @return string
     */
    public function getToggleId()
    {
        return $this->toggleId;
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

    /**
     * @param string $toggleId
     */
    public function setToggleId( $toggleId )
    {
        $this->toggleId = $toggleId;
    }
}