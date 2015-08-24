<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 10:31
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Gateway\ActivatedToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\DummyActivatedToggleGateway;

class GetActivatedTogglesTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    /**
     * @test
     */
    public function givenNoActivatedToggles_GetActivatedToggles_ReturnsEmptyArray()
    {
        $response = (new DummyActivatedToggleGateway())->getAllMyActivatedToggles();
        $this->assertEquals([], $response);
    }
}
