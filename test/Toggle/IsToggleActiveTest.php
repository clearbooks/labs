<?php
namespace Clearbooks\Labs\Toggle;
use Clearbooks\Labs\Toggle\Gateway\ActivatableToggleGatewayStub;

/**
 * Class IsToggleActiveTest
 */
class IsToggleActiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IsToggleActive
     */
    private $isToggleActive;

    const ACTIVE_FEATURE = 'Feature 1';

    const INACTIVE_FEATURE = 'Feature 2';

    const NON_EXISTENT_FEATURE = 'Feature 3';

    public function setUp()
    {
        $availabilities = [
            self::ACTIVE_FEATURE => true,
            self::INACTIVE_FEATURE => false
        ];
        $this->isToggleActive = new IsToggleActive( new ActivatableToggleGatewayStub( $availabilities ) );
    }

    /**
     * @test
     */
    public function givenNull_notActive()
    {
        $this->assertFalse( $this->isToggleActive->isToggleActive( null ) );
    }

    /**
     * @test
     */
    public function givenNonExistentFeature_notActive()
    {
        $this->assertFalse( $this->isToggleActive->isToggleActive( self::NON_EXISTENT_FEATURE ) );
    }

    /**
     * @test
     */
    public function givenInactiveFeature_notActive()
    {
        $this->assertFalse( $this->isToggleActive->isToggleActive( self::INACTIVE_FEATURE ) );
    }

    /**
     * @test
     */
    public function givenActiveFeature_isActive()
    {
        $this->assertTrue( $this->isToggleActive->isToggleActive( self::ACTIVE_FEATURE ) );
    }
}