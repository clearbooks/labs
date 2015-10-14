<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 12:09
 */

namespace Clearbooks\Labs\Feedback\UseCase;


interface AddFeedbackForToggle
{
    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function execute($toggleId, $mood, $message, $userId, $groupId);
}