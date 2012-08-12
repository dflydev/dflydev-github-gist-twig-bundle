<?php

/*
 * This file is a part of GitHub Gist Twig Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dflydev\Bundle\GitHubGistTwigBundle\Command\Cache;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear Command.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ClearCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('cache:clear:gitHubGist')
            ->setDescription('Clear gitHubGist cache')
            ->setHelp(<<<EOT
The <info>cache:clear:gitHubGist</info> command clears the gitHubGist cache.
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getKernel()->getContainer();
        $cacheDir = $container->getParameter('dflydev_twig_github_gist.cache_dir');

        $kernel = $this->container->get('kernel');
        $output->writeln(sprintf('Clearing the <info>Twig GitHub Gist</info> cache for the <info>%s</info> environment with debug <info>%s</info>', $kernel->getEnvironment(), var_export($kernel->isDebug(), true)));

        $container->get('filesystem')->remove($cacheDir);
    }
}
