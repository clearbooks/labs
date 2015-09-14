<?php
namespace Clearbooks\Labs\Feedback;

use Clearbooks\Labs\Feedback\Gateway\InsertFeedbackForToggle;
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
     * @var InsertFeedbackForToggle
     */
    private $gateway;

    /**
     * AddFeedbackForToggle constructor.
     * @param InsertFeedbackForToggle $gateway
     */
    public function __construct($gateway)
    {
        $this->gateway = $gateway;
    }


    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @return bool
     */
    public function execute( $toggleId, $mood, $message )
    {
        if(empty($toggleId) || empty($mood) || empty($message)){
            return false;
        }
        $this->gateway->addFeedbackForToggle($toggleId, $mood, $message);
        return true;
    }
}