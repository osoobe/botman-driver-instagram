<?php

namespace BotMan\Drivers\Instagram\Events;

class MessagingOptins extends InstagramEvent
{
    /**
     * Return the event name to match.
     *
     * @return string
     */
    public function getName()
    {
        return 'messaging_optins';
    }
}
