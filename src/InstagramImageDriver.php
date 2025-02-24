<?php

namespace BotMan\Drivers\Instagram;

use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Illuminate\Support\Collection;

class InstagramImageDriver extends InstagramDriver
{
    const DRIVER_NAME = 'InstagramImage';

    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest()
    {
        $validSignature = ! $this->config->has('instagram_app_secret') || $this->validateSignature();
        $messages = Collection::make($this->event->get('messaging'))->filter(function ($msg) {
            if (isset($msg['message']) && isset($msg['message']['attachments']) && isset($msg['message']['attachments'])) {
                return Collection::make($msg['message']['attachments'])->filter(function ($attachment) {
                    return (isset($attachment['type'])) && $attachment['type'] === 'image';
                })->isEmpty() === false;
            }

            return false;
        });

        return ! $messages->isEmpty() && $validSignature;
    }

    /**
     * Retrieve the chat message.
     *
     * @return array
     */
    public function getMessages()
    {
        if (empty($this->messages)) {
            $this->loadMessages();
        }

        return $this->messages;
    }

    /**
     * Load Instagram messages.
     */
    protected function loadMessages()
    {
        $messages = Collection::make($this->event->get('messaging'))->filter(function ($msg) {
            return isset($msg['message']) && isset($msg['message']['attachments']) && isset($msg['message']['attachments']);
        })->transform(function ($msg) {
            $message = new IncomingMessage(Image::PATTERN, $msg['sender']['id'], $msg['recipient']['id'], $msg);
            $message->setImages($this->getImagesUrls($msg));

            return $message;
        })->toArray();

        if (count($messages) === 0) {
            $messages = [new IncomingMessage('', '', '')];
        }

        $this->messages = $messages;
    }

    /**
     * Retrieve image urls from an incoming message.
     *
     * @param array $message
     * @return array A download for the image file.
     */
    public function getImagesUrls(array $message)
    {
        return Collection::make($message['message']['attachments'])->where('type',
            'image')->pluck('payload')->map(function ($item) {
                return new Image($item['url'], $item);
            })->toArray();
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasMatchingEvent()
    {
        return false;
    }
}
