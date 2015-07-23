<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 13:08
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\User\ToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\ToggleActivator;
use Clearbooks\Labs\User\UseCase\ToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\ToggleActivatorResponseHandler;

class AutoSubscriptionToggleShowEventHandler implements ToggleShowSubscriber,ToggleActivatorResponseHandler
{
    /**
     * @var AutoSubscriptionProvider
     */
    private $autoSubscriptionProvider;
    /**
     * @var ToggleActivator
     */
    private $toggleActivator;
    /** @var Response */
    private $activatorResponse;

    /**
     * AutoSubscriptionToggleShowEventHandler constructor.
     * @param AutoSubscriptionProvider $autoSubscriptionProvider
     * @param ToggleActivator $toggleActivator
     */
    public function __construct(AutoSubscriptionProvider $autoSubscriptionProvider,ToggleActivator $toggleActivator)
    {
        $this->autoSubscriptionProvider = $autoSubscriptionProvider;
        $this->toggleActivator = $toggleActivator;
    }

    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function handleToggleShow(ToggleShowEvent $event)
    {
        $subscribedSubscriptions = array_filter($this->autoSubscriptionProvider->getSubscriptions(),function(Subscription $s) {return $s->IsSubscribed();});

        $result = false;
        /** @var Subscription $subscription */
        foreach ( $subscribedSubscriptions as $subscription ) {
            // Request second parameter not exists
            $request = new Request($event->getToggleName(),$subscription->getUserId());
            $this->toggleActivator->execute($request, $this);
            $result = empty($this->activatorResponse->getErrors()) || $result;
        }
        return $result;
    }

    public function handleResponse(Response $response)
    {
        $this->activatorResponse = $response;
    }
}