<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\UseCase\CreateRelease;


class ResponseModel implements Response
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
     * @var string
     */
    private $id;

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
     * @return string
     */
    public function getReleaseId()
    {
        return $this->id;
    }

    /**
     * @param boolean $successful
     */
    public function setSuccessful( $successful )
    {
        $this->successful = $successful;
    }

    /**
     * @param \string[] $errors
     */
    public function setErrors( $errors )
    {
        $this->errors = $errors;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
//EOF ResponseModel.php