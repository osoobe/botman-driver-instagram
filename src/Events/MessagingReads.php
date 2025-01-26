<?php

namespace BotMan\Drivers\Instagram\Events;

class MessagingReads extends InstagramEvent
{
    /**
     * Return the event name to match.
     *
     * @return string
     */
    public function getName()
    {
        return 'messaging_reads';
    }
}
