<?php
namespace Clearbooks\Labs\Feedback\Gateway;
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 12:14
 */
interface InsertFeedbackForToggleGateway
{
    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @return void
     */
    public function addFeedbackForToggle($toggleId, $mood, $message);
}