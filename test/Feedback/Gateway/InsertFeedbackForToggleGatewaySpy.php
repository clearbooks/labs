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
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $groupId;

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function addFeedbackForToggle( $toggleId, $mood, $message, $userId, $groupId )
    {
        $this->toggleId = $toggleId;
        $this->mood = $mood;
        $this->message = $message;
        $this->userId = $userId;
        $this->groupId = $groupId;
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

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}