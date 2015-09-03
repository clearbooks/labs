<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Entity\User;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\User\ToggleStatusModifier\Request;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier\Response;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifierResponseHandler;

class AutoSubscriptionToggleShowEventHandler implements ToggleShowSubscriber
{
    /** @var AutoSubscriberProvider */
    private $autoSubscriberProvider;
    /** @var ToggleStatusModifier */
    private $toggleStatusModifier;
    /** @var Response */
    private $activatorResponse;

    /**
     * @param AutoSubscriberProvider $autoSubscriberProvider
     * @param ToggleStatusModifier   $toggleStatusModifier
     */
    public function __construct(AutoSubscriberProvider $autoSubscriberProvider, ToggleStatusModifier $toggleStatusModifier)
    {
        $this->autoSubscriberProvider = $autoSubscriberProvider;
        $this->toggleStatusModifier = $toggleStatusModifier;
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
            $request = new Request($event->getToggleName(), ToggleStatusModifier::TOGGLE_STATUS_ACTIVE, $user->getId());
            $this->activatorResponse = $this->toggleStatusModifier->execute($request);
            $result = empty($this->activatorResponse->getErrors()) || $result;
        }
        return $result;
    }
}
//EOF AutoSubscriptionToggleShowEventHandler.php
