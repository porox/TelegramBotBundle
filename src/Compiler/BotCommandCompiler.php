<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 2019-05-24
 * Time: 15:18.
 */

namespace Porox\TelegramBotBundle\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class BotCommandCompiler.
 */
class BotCommandCompiler implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('telegram_bot');
        $services = $container->findTaggedServiceIds('telegram_bot_command');

        foreach (array_keys($services) as $service) {
            $definition->addMethodCall('addCommand', [new Reference($service)]);
        }
    }
}
