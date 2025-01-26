<?php

namespace BotMan\Drivers\Instagram\Events;

class MessagingCheckoutUpdates extends InstagramEvent
{
    /**
     * Return the event name to match.
     *
     * @return string
     */
    public function getName()
    {
        return 'messaging_checkout_updates';
    }
}
