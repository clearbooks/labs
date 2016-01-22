<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:40
 */

namespace Clearbooks\Labs\Feedback\UseCase;


use Clearbooks\Labs\Feedback\Entity\ToggleFeedback;

interface GetAllFeedbackForToggles
{
    /**
     * @return ToggleFeedback[]
     */
    public function execute();
}