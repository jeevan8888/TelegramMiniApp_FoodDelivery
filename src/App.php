<?php declare(strict_types=1);

namespace ShahradElahi\DurgerKing;

use TelegramBot\Entities\Update;
use TelegramBot\Request;
use TelegramBot\Telegram;

/**
 * Class App
 *
 * This class is the main class of the application.
 * It is responsible for handling the incoming updates and
 * sending the responses.
 *
 * @link https://core.telegram.org/bots/api#getting-updates
 */
class App extends \TelegramBot\UpdateHandler {

   /**
    * This method is called when the bot receives a new message.
    *
    * @param Update $update
    * @return void
    */
   public function __process(Update $update): void {

      Telegram::setAdminId($_ENV['ADMIN_CHAT_ID']);

      if ($update->getMessage()->getText() === '/ping') {
         Request::sendMessage([
            'chat_id' => $update->getMessage()->getChat()->getId(),
            'parse_mode' => 'Markdown',
            'text' => '`Pong!`',
         ]);
      }

      self::addPlugins([
         Plugins\Commands::class,
         Plugins\WebService::class,
      ]);
   }

}