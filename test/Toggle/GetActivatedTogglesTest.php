<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 24/08/2015
 * Time: 10:31
 */

namespace Clearbooks\Labs\Toggle;
use Clearbooks\Labs\Client\Toggle\Entity\Group;
use Clearbooks\Labs\Client\Toggle\Entity\GroupStub;
use Clearbooks\Labs\Client\Toggle\Entity\User;
use Clearbooks\Labs\Client\Toggle\Entity\UserStub;
use Clearbooks\Labs\Toggle\Entity\ActivatedToggleStub;
use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\Parasol;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayDummy;
use Clearbooks\Labs\Toggle\Gateway\GetAllTogglesGatewayStub;

class GetActivatedTogglesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Group
     */
    private $group;

    public function setUp(){
        $this->user = new UserStub("1");
        $this->group = new GroupStub("1");
    }

    /**
     * @test
     */
    public function givenNoActivatedToggles_GetActivatedToggles_ReturnsEmptyArray()
    {
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayDummy, new FailingToggleCheckerStub))->execute( $this->user, $this->group );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenOneActivatedToggle_getActivatedToggles_ReturnsActivatedToggleroo()
    {
        $expectedToggles = [ new Brolly ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $expectedToggles ), new PassingToggleCheckerStub ) )->execute( $this->user, $this->group );
        $this->assertEquals( $expectedToggles, $response );
    }

    /**
     * @test
     */
    public function givenOneInactivatedToggle_getActivatedToggles_ReturnsEmptyArray()
    {
        $expectedToggles = [ new Brolly ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $expectedToggles ), new FailingToggleCheckerStub ) )->execute( $this->user, $this->group );
        $this->assertEquals( [], $response );
    }

    /**
     * @test
     */
    public function givenOneActiveAndOneInactivatedToggle_getActivatedToggles_ReturnsOnlyActiveToggleArray()
    {
        $toggles = [ new Brolly, new Parasol ];
        $response = ( new GetActivatedToggles( new GetAllTogglesGatewayStub( $toggles ), new OnlyBrolliesToggleChecker($toggles) ) )->execute( $this->user, $this->group );
        $this->assertEquals( [new Brolly()], $response );
    }

    /**
     * @test
     */
    public function givenOneActiveToggle_getActivatedToggles_PassesCorrectInformationToToggleChecker()
    {
        $brolly = new Brolly;
        $spy = new ToggleCheckerSpy($brolly);

        ( new GetActivatedToggles( new GetAllTogglesGatewayStub( [ $brolly ] ), $spy ) )->execute( $this->user, $this->group );

        $this->assertEquals( $brolly->getName(), $spy->getToggleName() );
        $this->assertEquals( $this->user, $spy->getUser() );
        $this->assertEquals( $this->group, $spy->getGroup() );
    }
}
