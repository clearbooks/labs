<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:40
 */

namespace Clearbooks\Labs\Feedback\UseCase;


use Clearbooks\Labs\Feedback\Entity\IToggleFeedback;

interface GetAllFeedbackForToggles
{
    /**
     * @return IToggleFeedback[]
     */
    public function execute();
}