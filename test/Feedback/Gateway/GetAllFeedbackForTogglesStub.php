<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:55
 */

namespace Clearbooks\Labs\Feedback\Gateway;


use Clearbooks\Labs\Feedback\Entity\IToggleFeedback;

class GetAllFeedbackForTogglesStub implements GetFeedbackForTogglesGateway
{

    /** @var IToggleFeedback[] */
    private $expectedToggles;

    /**
     * GetAllFeedbackForTogglesStub constructor.
     * @param IToggleFeedback[] $toggleFeedback
     */
    public function __construct($toggleFeedback)
    {
        $this->expectedToggles = $toggleFeedback;
    }

    /**
     * @return IToggleFeedback[]
     */
    public function getFeedbackForToggles()
    {
        return $this->expectedToggles;
    }
}