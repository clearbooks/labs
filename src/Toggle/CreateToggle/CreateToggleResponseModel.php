<?php
namespace Clearbooks\Labs\Toggle\CreateToggle;

use Clearbooks\Labs\Response\ValidatedResponseModel;
use Clearbooks\Labs\Toggle\UseCase\CreateToggle\CreateToggleResponse;

/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 16/09/2015
 * Time: 14:52
 */
class CreateToggleResponseModel extends ValidatedResponseModel implements CreateToggleResponse
{

    /**
     * @var string
     */
    private $toggleId;

    /**
     * @return string
     */
    public function getToggleId()
    {
        return $this->toggleId;
    }

    /**
     * @param string $toggleId
     */
    public function setToggleId( $toggleId )
    {
        $this->toggleId = $toggleId;
    }
}