<?php

/*
 * This file is a part of GitHub Gist Twig Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dflydev\Bundle\GitHubGistTwigBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * GitHub Gist Twig Extension.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class DflydevGitHubGistTwigExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['cache']) && isset($config['cache']['enabled']) && $config['cache']['enabled']) {
            $container
                ->findDefinition('dflydev_twig_github_gist.extension')
                ->addMethodCall('setCache', array(new Reference('dflydev_twig_github_gist.cache.filesystem')));
        }
    }
}
