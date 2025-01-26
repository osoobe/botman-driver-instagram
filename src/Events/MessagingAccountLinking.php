<?php

namespace BotMan\Drivers\Instagram\Events;

class MessagingAccountLinking extends InstagramEvent
{
    /**
     * Return the event name to match.
     *
     * @return string
     */
    public function getName()
    {
        return 'messaging_account_linking';
    }
}
