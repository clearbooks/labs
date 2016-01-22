<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:55
 */

namespace Clearbooks\Labs\Feedback\Gateway;


class GetAllFeedbackForTogglesStub implements GetFeedbackForTogglesGateway
{

    const FEEDBACK = "meow";

    public function getFeedbackForToggles()
    {
        return self::FEEDBACK;
    }
}