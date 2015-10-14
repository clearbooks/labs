<?php
namespace Clearbooks\Labs\Feedback\Gateway;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggleGateway;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 12:18
 */
class InsertFeedbackForToggleGatewayDummy implements InsertFeedbackForToggleGateway
{

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @param string $userId
     * @param string $groupId
     * @return bool
     */
    public function addFeedbackForToggle( $toggleId, $mood, $message, $userId, $groupId ){return true;}
}