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
     * @return bool
     */
    private function isGivenParametersEmpty( $toggleId, $mood, $message )
    {
        return empty( $toggleId ) || empty( $message ) || !is_bool( $mood );
    }

    /**
     * @param string $toggleId
     * @param bool $mood
     * @param string $message
     * @return bool
     */
    public function execute( $toggleId, $mood, $message )
    {
        if ( $this->isGivenParametersEmpty( $toggleId, $mood, $message ) ) {
            return false;
        }
        $this->gateway->addFeedbackForToggle( $toggleId, $mood, $message );
        return true;
    }
}