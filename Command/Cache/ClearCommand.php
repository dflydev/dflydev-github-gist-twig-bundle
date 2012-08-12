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

use Dflydev\Sculpin\Bundle\TwigGitHubGistBundle\TwigGitHubGistBundle;
use Sculpin\Core\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear Command.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ClearCommand extends ContainerAwareCommand
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
        $container = $this->getContainer();
        $cacheDir = $this->getContainer()->getParameter('dflydev_twig_github_gist.cache_dir');

        $kernel = $this->getContainer()->get('kernel');
        $output->writeln(sprintf('Clearing the Twig GitHub Gist cache for the <info>%s</info> environment with debug <info>%s</info>', $kernel->getEnvironment(), var_export($kernel->isDebug(), true)));

        $this->getContainer()->get('filesystem')->remove($cacheDir);
    }
}
