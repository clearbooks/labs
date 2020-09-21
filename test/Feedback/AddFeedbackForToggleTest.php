<?php
namespace Clearbooks\Labs\Feedback;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGatewaySpy;
use PHPUnit\Framework\TestCase;
use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGatewayDummy;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 11:27
 */
class AddFeedbackForToggleTest extends TestCase
{

    /**
     * @test
     */
    public function givenNoToggleIdProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( null, true,
            "this is the test!", "1", "1" );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenNoMoodRatingProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( "1", null,
            "this is the test!", "1", "1" );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenNoMessageProvided_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute( "1", true,
            null, "1", "1" );
        $this->assertFalse( $response );
    }

    /**
     * @test
     */
    public function givenNoUserIdProvided_returnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute(
            "1", true, "message", null, "1");
        $this->assertFalse($response);
    }

    /**
     * @test
     */
    public function givenNoGroupIdeProvided_returnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy ) )->execute(
            "1", true, "message", "1", null);
        $this->assertFalse($response);
    }

    /**
     * @test
     */
    public function givenAllParametersProvided_ReturnTrue()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewayDummy() ) )->execute( "1", false,
            "this is the test!", "1", "1" );
        $this->assertTrue( $response );
    }

    /**
     * @test
     */
    public function givenAllParametersProvided_duringInsertingOfFeedback_CorrectParametersAreProvided()
    {
        $spy = new InsertFeedbackForToggleGatewaySpy;
        $toggleId = "1";
        $mood = true;
        $message = "this is the test!";
        $userId = "2";
        $groupId = "3";

        ( new AddFeedbackForToggle( $spy ) )->execute( $toggleId, $mood, $message, $userId, $groupId);

        $expected = [$toggleId, $mood, $message, $userId, $groupId];
        $actual = [ $spy->getToggleId(), $spy->getMood(), $spy->getMessage(), $spy->getUserId(), $spy->getGroupId() ];
        
        $this->assertEquals( $expected, $actual );
    }

    /**
     * @test
     */
    public function givenAllParametersProvidedButToggleDoesNotExist_ReturnFalse()
    {
        $response = ( new AddFeedbackForToggle( new InsertFeedbackForToggleGatewaySpy ) )->execute( "2", true,
            "this is the test!", "1", "1" );
        $this->assertFalse( $response );
    }
}
