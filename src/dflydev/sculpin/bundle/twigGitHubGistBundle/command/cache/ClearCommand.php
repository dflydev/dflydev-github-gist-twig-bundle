<?php

/*
 * This file is a part of Twig GitHub Gist Sculpin Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dflydev\sculpin\bundle\twigGitHubGistBundle\command\cache;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use dflydev\sculpin\bundle\twigGitHubGistBundle\TwigGitHubGistBundle;
use sculpin\console\command\Command;

class ClearCommand extends Command
{
    /**
     * @{inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('cache:clear:gitHubGist')
            ->setDescription('Clear gitHubGist cache')
            ->setHelp(<<<EOT
The <info>cache:clear:gitHubGist</info> command clears the gitHubGist cache.
EOT
            )
        ;
    }

    /**
     * @{inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sculpin = $this->getSculpinApplication()->createSculpin();
        $sculpin->start();
        $sculpin->clearCacheFor($sculpin->configuration()->get(TwigGitHubGistBundle::CONFIG_CACHE_DIRECTORY));
    }
}
