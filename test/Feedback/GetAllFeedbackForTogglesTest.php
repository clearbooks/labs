<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:50
 */

namespace Clearbooks\Labs\Feedback;


use Clearbooks\Labs\Feedback\Gateway\GetAllFeedbackForTogglesStub;
use Clearbooks\Labs\Feedback\UseCase\GetAllFeedbackForToggles;

class GetAllFeedbackForTogglesTest extends \PHPUnit_Framework_TestCase
{

    /** @var GetAllFeedbackForToggles */
    private $getAllFeedback;

    /** @var GetAllFeedbackForTogglesStub */
    private $gateway;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new GetAllFeedbackForTogglesStub();
        $this->getAllFeedback = new \Clearbooks\Labs\Feedback\GetAllFeedbackForToggles($this->gateway);
    }

    /**
     * @test
     */
    public function givenGateway_whenGettingAllFeedback_returnValuesFromGateway()
    {
        $this->assertEquals(GetAllFeedbackForTogglesStub::FEEDBACK, $this->getAllFeedback->execute());
    }


}
