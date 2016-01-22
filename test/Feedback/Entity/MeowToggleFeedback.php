<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 11:15
 */

namespace Clearbooks\Labs\Feedback\Entity;


class MeowToggleFeedback implements ToggleFeedback
{

    const NAME = "Meow";
    const MOOD = 1;
    const MESSAGE = "Meow meow";
    const USER_ID = 1001;
    const GROUP_ID = 2002;

    /**
     * @return string
     */
    public function getToggleName()
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function getFeedbackMood()
    {
        return self::MOOD;
    }

    /**
     * @return string
     */
    public function getFeedbackMessage()
    {
        return self::MESSAGE;
    }

    /**
     * @return string
     */
    public function getFeedbackUserId()
    {
        return self::USER_ID;
    }

    /**
     * @return string
     */
    public function getFeedbackGroupId()
    {
        return self::GROUP_ID;
    }
}