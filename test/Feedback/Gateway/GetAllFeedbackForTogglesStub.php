<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:55
 */

namespace Clearbooks\Labs\Feedback\Gateway;


use Clearbooks\Labs\Feedback\Entity\ToggleFeedback;

class GetAllFeedbackForTogglesStub implements GetFeedbackForTogglesGateway
{

    /** @var ToggleFeedback[] */
    private $expectedToggles;

    /**
     * GetAllFeedbackForTogglesStub constructor.
     * @param ToggleFeedback[] $toggleFeedback
     */
    public function __construct($toggleFeedback)
    {
        $this->expectedToggles = $toggleFeedback;
    }

    /**
     * @return ToggleFeedback[]
     */
    public function getFeedbackForToggles()
    {
        return $this->expectedToggles;
    }
}