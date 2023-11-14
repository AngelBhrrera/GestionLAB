<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('{message}', function($botman, $message) {

            switch($message){
                case 'hola':
                    $this->askName($botman);
                    break;
                case 'nombre':
                    $user = $botman->userStorage()->find();
                    if ($user->has('name')) {
                        $botman->reply('You are '.$user->get('name'));
                    } else {
                        $botman->reply('I do not know you yet.');
                    }
                    break;
                case 'popo':
                    $botman->reply('comes');
                    break;
                default:
                    $botman->reply("no entendí master");
                    break;
            }

        });

        $botman->listen();

    }




    /**
     * Place your BotMan logic here.
     */
    public function askName(BotMan $bot)
    {
        $bot->ask('Hola! What is your Name?', function(Answer $answer) {

            $nombre = $answer->getText();


            $this->say('Nice to meet you '.$nombre);
            $this->bot->userStorage()->save([
                'name' => $nombre,
            ]);
        });

    }
}
