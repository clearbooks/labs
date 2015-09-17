<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 16/07/15
 */

namespace Clearbooks\Labs\Release\CreateRelease;


use Clearbooks\Labs\Release\UseCase\CreateRelease\CreateReleaseResponse;
use Clearbooks\Labs\Response\ValidatedResponseModel;

class CreateReleaseResponseModel extends ValidatedResponseModel implements CreateReleaseResponse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @return string
     */
    public function getReleaseId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId( $id )
    {
        $this->id = $id;
    }
}
//EOF ResponseModel.php