<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 12:41
 */

namespace Clearbooks\Labs\Feedback\Gateway;


class InsertFeedbackForToggleGatewaySpy implements InsertFeedbackForToggleGateway
{
    /**
     * @var string
     */
    private $toggleId = "";

    /**
     * @var bool
     */
    private $mood = null;

    /**
     * @var string
     */
    private $message = "";

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @return bool
     */
    public function addFeedbackForToggle( $toggleId, $mood, $message )
    {
        $this->toggleId = $toggleId;
        $this->mood = $mood;
        $this->message = $message;
        return $this->toggleId === "1";
    }

    /**
     * @return string
     */
    public function getToggleId()
    {
        return $this->toggleId;
    }

    /**
     * @return null
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}