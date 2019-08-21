<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 2019-08-21
 * Time: 11:53
 */
namespace Porox\TelegramBotBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * Class TelegramBotExtension
 *
 * @package Porox\TelegramBotBundle\DependencyInjection
 */
class TelegramBotExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }

}