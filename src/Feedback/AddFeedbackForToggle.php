<?php
namespace Clearbooks\Labs\Feedback;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGateway;
use Clearbooks\Labs\Feedback\UseCase\AddFeedbackForToggle as IAddFeedbackForToggle;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 11:53
 */
class AddFeedbackForToggle implements IAddFeedbackForToggle
{
    /**
     * @var InsertFeedbackForToggleGateway
     */
    private $gateway;

    /**
     * AddFeedbackForToggle constructor.
     * @param InsertFeedbackForToggleGateway $gateway
     */
    public function __construct( InsertFeedbackForToggleGateway $gateway )
    {
        $this->gateway = $gateway;
    }


    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @param $userId
     * @param $groupId
     * @return bool
     */
    private function isGivenParametersEmpty( $toggleId, $mood, $message, $userId, $groupId )
    {
        return $this->messageContentsEmpty($toggleId, $mood, $message) || !$this->userAndGroupIDEmpty($userId, $groupId);
    }

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function execute( $toggleId, $mood, $message, $userId, $groupId )
    {
        if ( $this->isGivenParametersEmpty( $toggleId, $mood, $message, $userId, $groupId ) ) {
            return false;
        }
        return $this->gateway->addFeedbackForToggle( $toggleId, $mood, $message, $userId, $groupId );
    }

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    private function userAndGroupIDEmpty($userId, $groupId)
    {
        return empty($userId) || empty($groupId);
    }

    /**
     * @param $toggleId
     * @param $mood
     * @param $message
     * @return bool
     */
    private function messageContentsEmpty($toggleId, $mood, $message)
    {
        return empty($toggleId) || empty($message) || !is_bool($mood);
    }
}