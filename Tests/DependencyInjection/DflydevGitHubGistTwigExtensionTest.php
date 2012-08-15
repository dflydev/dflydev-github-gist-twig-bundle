<?php

/*
 * This file is a part of GitHub Gist Twig Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dflydev\Bundle\GitHubGistTwigBundle\Tests\DependencyInjection;

use Dflydev\Bundle\GitHubGistTwigBundle\DependencyInjection\DflydevGitHubGistTwigExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * DflydevGitHubGistTwigExtension Test.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class DflydevGitHubGistTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $configuration;

    /**
     * Test default cache settings
     */
    public function testCacheDefault()
    {
        $this->configuration = new ContainerBuilder;
        $loader = new DflydevGitHubGistTwigExtension;
        $config = $this->getEmptyConfig();

        $loader->load(array($config), $this->configuration);

        $definition = $this->configuration->getDefinition('dflydev_twig_github_gist.extension');
        $calls = $definition->getMethodCalls();

        foreach ($calls as $call) {
            list ($methodName, $args) = $call;
            if ('setCache' === $methodName) {
                // Default should be to set cache to the filesystem cache.
                $this->assertEquals('dflydev_twig_github_gist.cache.filesystem', $args[0]);

                return;
            }
        }

        $this->fail('setCache method should be called');
    }

    /**
     * Test enabled cache
     */
    public function testCacheEnabled()
    {
        $this->configuration = new ContainerBuilder;
        $loader = new DflydevGitHubGistTwigExtension;
        $config = $this->getEmptyConfig();

        $config['cache'] = array('enabled' => true);

        $loader->load(array($config), $this->configuration);

        $definition = $this->configuration->getDefinition('dflydev_twig_github_gist.extension');
        $calls = $definition->getMethodCalls();

        foreach ($calls as $call) {
            list ($methodName, $args) = $call;
            if ('setCache' === $methodName) {
                // Default should be to set cache to the filesystem cache.
                $this->assertEquals('dflydev_twig_github_gist.cache.filesystem', $args[0]);

                return;
            }
        }

        $this->fail('setCache method should be called');
    }

    /**
     * Test disabled cache
     */
    public function testCacheDisabled()
    {
        $this->configuration = new ContainerBuilder;
        $loader = new DflydevGitHubGistTwigExtension;
        $config = $this->getEmptyConfig();

        $config['cache'] = array('enabled' => false);

        $loader->load(array($config), $this->configuration);

        $definition = $this->configuration->getDefinition('dflydev_twig_github_gist.extension');
        $calls = $definition->getMethodCalls();

        foreach ($calls as $call) {
            list ($methodName, $args) = $call;
            if ('setCache' === $methodName) {
                // Default should be to set cache to the filesystem cache.
                $this->fail('setCache method should not be called');

                return;
            }
        }
    }

    /**
     * Get empty configuration
     *
     * @return array
     */
    protected function getEmptyConfig()
    {
        return array();
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }
}
