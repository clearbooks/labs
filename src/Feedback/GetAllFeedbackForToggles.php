<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/16
 * Time: 10:49
 */

namespace Clearbooks\Labs\Feedback;


use Clearbooks\Labs\Feedback\Gateway\GetFeedbackForTogglesGateway;

class GetAllFeedbackForToggles implements UseCase\GetAllFeedbackForToggles
{
    /**
     * @var Gateway\GetFeedbackForTogglesGateway
     */
    private $gateway;

    /**
     * GetAllFeedbackForToggles constructor.
     * @param Gateway\GetFeedbackForTogglesGateway $gateway
     */
    public function __construct(GetFeedbackForTogglesGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function execute()
    {
        return $this->gateway->getFeedbackForToggles();
    }
}