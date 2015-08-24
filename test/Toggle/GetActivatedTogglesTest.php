<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 10:31
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Entity\ActivatedToggleStub;
use Clearbooks\Labs\Toggle\Gateway\ActivatedToggleGatewayDummy;
use Clearbooks\Labs\Toggle\Gateway\ActivatedToggleGatewayStub;

class GetActivatedTogglesTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    /**
     * @test
     */
    public function givenNoMyActivatedToggles_GetActivatedToggles_ReturnsEmptyArray()
    {
        $response = (new ActivatedToggleGatewayDummy())->getAllMyActivatedToggles();
        $this->assertEquals([], $response);
    }

    /**
     * @test
     */
    public function givenExistentMyActivatedToggle_getActivatedToggles_ReturnsArrayOfToggles()
    {

        $expectedToggles = [new ActivatedToggleStub()];

        $response = (new ActivatedToggleGatewayStub($expectedToggles))->getAllMyActivatedToggles();
        $this->assertEquals( $expectedToggles, $response);
    }
}
