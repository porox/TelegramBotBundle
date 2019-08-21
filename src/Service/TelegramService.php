<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 2019-05-24
 * Time: 14:47.
 */

namespace Porox\TelegramBotBundle\Service;

use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

/**
 * Class CustomTelegram.
 */
class TelegramService extends Telegram
{
    /**
     * @var Command[]
     */
    protected $commands;

    /**
     * CustomTelegram constructor.
     *
     * @param string $api_key
     * @param string $bot_username
     * @param Client $clientHttp
     *
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function __construct(Client $clientHttp, string $api_key, string $bot_username = '')
    {
        parent::__construct($api_key, $bot_username);
        Request::setClient($clientHttp);
        $this->useGetUpdatesWithoutDatabase();
    }

    /**
     * @param Command $command
     */
    public function addCommand(Command $command)
    {
        $this->commands[$command->getName()] = $command;
    }

    /**
     * @return array
     */
    public function getCommandsList()
    {
        return $this->commands;
    }

    /**
     * @param string $command
     *
     * @return Command|null
     */
    public function getCommandObject($command)
    {
        $obj = $this->commands[$command] ?? null;
        if ($obj instanceof Command) {
            $obj->setUpdate($this->update);
        }

        return $obj;
    }
}
