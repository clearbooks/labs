<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Entity\User;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\User\UserToggleActivator\Request;
use Clearbooks\Labs\User\UseCase\UserToggleActivator;
use Clearbooks\Labs\User\UseCase\UserToggleActivator\Response;
use Clearbooks\Labs\User\UseCase\UserToggleActivatorResponseHandler;

class AutoSubscriptionToggleShowEventHandler implements ToggleShowSubscriber,UserToggleActivatorResponseHandler
{
    /** @var AutoSubscriberProvider */
    private $autoSubscriberProvider;
    /** @var UserToggleActivator */
    private $toggleActivator;
    /** @var Response */
    private $activatorResponse;

    /**
     * @param AutoSubscriberProvider $autoSubscriberProvider
     * @param UserToggleActivator $toggleActivator
     */
    public function __construct(AutoSubscriberProvider $autoSubscriberProvider,UserToggleActivator $toggleActivator)
    {
        $this->autoSubscriberProvider = $autoSubscriberProvider;
        $this->toggleActivator = $toggleActivator;
    }

    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function handleToggleShow(ToggleShowEvent $event)
    {
        $subscribers = $this->autoSubscriberProvider->getSubscribers();

        $result = false;
        /** @var User $user */
        foreach ( $subscribers as $user ) {
            $request = new Request($event->getToggleName(),$user->getId());
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
//EOF AutoSubscriptionToggleShowEventHandler.php