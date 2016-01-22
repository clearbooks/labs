<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:50
 */

namespace Clearbooks\Labs\Feedback;


use Clearbooks\Labs\Feedback\Entity\MeowToggleFeedback;
use Clearbooks\Labs\Feedback\Entity\IToggleFeedback;
use Clearbooks\Labs\Feedback\Gateway\GetAllFeedbackForTogglesStub;
use Clearbooks\Labs\Feedback\UseCase\GetAllFeedbackForToggles;

class GetAllFeedbackForTogglesTest extends \PHPUnit_Framework_TestCase
{

    /** @var GetAllFeedbackForToggles */
    private $getAllFeedback;

    /** @var GetAllFeedbackForTogglesStub */
    private $gateway;

    /** @var IToggleFeedback[] */
    private $expectedToggles;

    protected function setUp()
    {
        parent::setUp();

        $this->expectedToggles = [ new MeowToggleFeedback ];
        $this->gateway = new GetAllFeedbackForTogglesStub($this->expectedToggles);
        $this->getAllFeedback = new \Clearbooks\Labs\Feedback\GetAllFeedbackForToggles($this->gateway);
    }

    /**
     * @test
     */
    public function givenGateway_whenGettingFeedback_returnValuesFromGateway()
    {
        $this->assertEquals($this->expectedToggles, $this->getAllFeedback->execute());
    }


}
