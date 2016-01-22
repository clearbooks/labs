<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:46
 */

namespace Clearbooks\Labs\Feedback\Entity;


interface IToggleFeedback
{

    /**
     * @return string
     */
    public function getToggleName();

    /**
     * @return string
     */
    public function getFeedbackMood();

    /**
     * @return string
     */
    public function getFeedbackMessage();

    /**
     * @return string
     */
    public function getFeedbackUserId();

    /**
     * @return string
     */
    public function getFeedbackGroupId();

}