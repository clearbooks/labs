<?php
namespace Clearbooks\Labs\Feedback;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGatewaySpy;
use PHPUnit_Framework_TestCase;
use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGatewayDummy;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 11:27
 */
class AddFeedbackForToggleTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function givenNoToggleIdProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( null, true,
            "this is the test!" );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenNoMoodRatingProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( "1", null,
            "this is the test!" );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenNoMessageProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( "1", true,
            null );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenAllParametersProvided_ReturnTrue()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( "1", true,
            "this is the test!" );
        $this->assertTrue( $response );
    }

    /**
     * @test
     */
    public function givenAllParametersProvided_duringInsertingOfFeedback_CorrectParametersAreProvided()
    {
        $spy = new InsertFeedbackForToggleGatewaySpy;
        ( new AddFeedbackForToggle( $spy ) )->execute( "1", true,
            "this is the test!" );
        $expected = [ "1", true, "this is the test!" ];
        $actual = [ $spy->getToggleId(), $spy->getMood(), $spy->getMessage() ];
        $this->assertEquals( $expected, $actual );
    }
}
