<?php

namespace BotMan\Drivers\Instagram\Commands;

use BotMan\BotMan\Http\Curl;
use Illuminate\Console\Command;

class AddGreetingText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'botman:instagram:AddGreetingText';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a Instagram Greeting Text to your message start screen.';

    /**
     * @var Curl
     */
    private $http;

    /**
     * Create a new command instance.
     *
     * @param Curl $http
     */
    public function __construct(Curl $http)
    {
        parent::__construct();
        $this->http = $http;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $payload = config('botman.instagram.greeting_text');

        if (! $payload) {
            $this->error('You need to add a Instagram greeting text to your BotMan Instagram config in instagram.php.');
            exit;
        }

        $response = $this->http->post(
            'https://graph.facebook.com/v11.0/me/messenger_profile?access_token='.config('botman.instagram.token'),
            [], $payload);

        $responseObject = json_decode($response->getContent());

        if ($response->getStatusCode() == 200) {
            $this->info('Greeting text was set.');
        } else {
            $this->error('Something went wrong: '.$responseObject->error->message);
        }
    }
}
