<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:40
 */

namespace Clearbooks\Labs\Feedback\Gateway;


use Clearbooks\Labs\Feedback\Entity\ToggleFeedback;

interface GetFeedbackForTogglesGateway
{
    /**
     * @return ToggleFeedback[]
     */
    public function getFeedbackForToggles();

}