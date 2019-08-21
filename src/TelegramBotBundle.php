<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 2019-08-21
 * Time: 11:45
 */
namespace Porox\TelegramBotBundle;

use Porox\TelegramBotBundle\Compiler\BotCommandCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TelegramBotBundle
 *
 * @package Porox\TelegramBotBundle
 */
class TelegramBotBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new BotCommandCompiler());
    }

}