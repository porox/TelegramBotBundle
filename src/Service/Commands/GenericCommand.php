<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 2019-05-24
 * Time: 15:24.
 */

namespace Porox\TelegramBotBundle\Service\Commands;

use Longman\TelegramBot\Commands\AdminCommand;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Request;

class GenericCommand extends AdminCommand
{
    /**
     * @var string
     */
    protected $name = 'generic';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object
        if (null == $message) {
            return  Request::emptyResponse();
        }
        $chat_id = $message->getChat()->getId() ?? null;   // Get the current Chat ID
        $this->telegram->getCommandsList();
        $res = ' Команда не найдена.'.PHP_EOL;
        $res .= ' Список доступных комманд: '.PHP_EOL;
        foreach ($this->telegram->getCommandsList() as $command) {
            if ($command instanceof Command) {
                if ($command->isEnabled()
                   && !$command->isAdminCommand()
                   && 'generic' !== $command->getName()
               ) {
                    $res .= $command->getName().' '.$command->getUsage().' '.$command->getDescription().'.'.PHP_EOL;
                }
            }
        }
        $data = [
            'chat_id' => $chat_id,
            'text' => $res,
        ];

        return Request::sendMessage($data);
    }
}
