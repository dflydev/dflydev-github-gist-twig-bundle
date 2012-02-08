<?php

/*
 * This file is a part of Twig GitHub Gist Sculpin Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dflydev\sculpin\bundle\twigGitHubGistBundle;

use dflydev\twig\extension\gitHub\gist\GistTwigExtension;
use dflydev\twig\extension\gitHub\gist\cache\FilesystemCache;
use sculpin\bundle\AbstractBundle;
use sculpin\bundle\twigBundle\TwigBundle;
use sculpin\bundle\twigBundle\TwigFormatter;
use sculpin\formatter\IFormatter;
use sculpin\Sculpin;

class TwigGitHubGistBundle extends AbstractBundle
{
    /**
     * Is this bundle enabled?
     * @var string
     */
    const CONFIG_ENABLED = 'twig_github_gist.enabled';

    /**
     * Is cache enabled?
     * @var string
     */
    const CONFIG_CACHE_ENABLED = 'twig_github_gist.cache.enabled';

    /**
     * Name of cache directory
     * @var string
     */
    const CONFIG_CACHE_DIRECTORY = 'twig_github_gist.cache.directory';

    /**
     * Cache directory
     * @var string
     */
    protected $cacheDirectory;

    
    /**
     * @{inheritdoc}
     */
    public function configureBundle(Sculpin $sculpin)
    {
        if ($sculpin->configuration()->get(self::CONFIG_ENABLED)) {
            $this->cacheDirectory = $sculpin->prepareCacheFor($sculpin->configuration()->get(self::CONFIG_CACHE_DIRECTORY));
            $sculpin->registerFormatterConfigurationCallback(
                TwigBundle::FORMATTER_NAME,
                array($this, 'configureTwigFormatter')
            );
        }
    }

    /**
     * Configure Twig formatter callback
     * @param Sculpin $sculpin
     * @param IFormatter $formatter
     */
    public function configureTwigFormatter(Sculpin $sculpin, IFormatter $formatter)
    {
        if ($formatter instanceof TwigFormatter) {
            if ($sculpin->configuration()->get(self::CONFIG_CACHE_ENABLED)) {
                $cache = new FilesystemCache($this->cacheDirectory);
            } else {
                $cache = null;
            }
            $gistTwigExtension = new GistTwigExtension(null, $cache);
            $formatter->twig()->addExtension($gistTwigExtension);
        }
    }
}
