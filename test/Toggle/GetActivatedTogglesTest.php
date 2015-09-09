<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 10:31
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Entity\ActivatedToggleStub;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayDummy;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayStub;

class GetActivatedTogglesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function givenNoMyActivatedToggles_GetActivatedToggles_ReturnsEmptyArray()
    {
        $response = (new GetActivatedToggles(new GetAllTogglesGatewayDummy()))->execute("1");
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function givenExistentMyActivatedToggle_getActivatedToggles_ReturnsArrayOfToggles()
    {

        $expectedToggles = [new ActivatedToggleStub()];

        $response = (new GetActivatedToggles(new GetAllTogglesGatewayStub($expectedToggles )))->execute("1");
        $this->assertEquals($expectedToggles, $response);
    }
}
