<?php
namespace Clearbooks\Labs\Feedback\Gateway;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggle;

/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 14/09/2015
 * Time: 12:18
 */
class InsertFeedbackForToggleDummy implements InsertFeedbackForToggle
{

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @return void
     */
    public function addFeedbackForToggle( $toggleId, $mood, $message ){}
}