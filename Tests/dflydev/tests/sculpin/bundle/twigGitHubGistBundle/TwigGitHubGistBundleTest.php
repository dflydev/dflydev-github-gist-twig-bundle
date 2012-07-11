<?php

/*
 * This file is a part of Twig GitHub Gist Sculpin Bundle.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dflydev\tests\sculpin\bundle\twigGitHubGistBundle;

use dflydev\sculpin\bundle\twigGitHubGistBundle\TwigGitHubGistBundle;
use sculpin\bundle\twigBundle\TwigBundle;

class TwigGitHubGistBundleTest extends \PHPUnit_Framework_TestCase
{
    public function getConfigurationMock($enabled = null, $cacheEnabled = null, $cacheDirectory = null)
    {
        if ($enabled === null) { $enabled = true; }
        if ($cacheEnabled === null) { $cacheEnabled = true; }
        if ($cacheDirectory === null) { $cacheDirectory = 'twigGitHubGist'; }
        $configuration = $this
            ->getMockBuilder('sculpin\configuration\Configuration')
            ->disableOriginalConstructor()
            ->getMock();
        $map = array(
            array(TwigGitHubGistBundle::CONFIG_ENABLED, $enabled),
            array(TwigGitHubGistBundle::CONFIG_CACHE_ENABLED, $cacheEnabled),
            array(TwigGitHubGistBundle::CONFIG_CACHE_DIRECTORY, $cacheDirectory),
            array('exclude', array()),
            array('core_exclude', array()),
        );
        $configuration
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap($map));
        return $configuration;
    }

    public function testConfigureBundleDisabled()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $sculpin = $this
            ->getMockBuilder('sculpin\Sculpin')
            ->disableOriginalConstructor()
            ->getMock();
        $sculpin
            ->expects($this->once())
            ->method('configuration')
            ->will($this->returnValue($this->getConfigurationMock(false)));
        $sculpin
            ->expects($this->never())
            ->method('prepareCacheFor');
        $twigGitHubGistBundle = new TwigGitHubGistBundle();
        $twigGitHubGistBundle;
    }

    public function testConfigureBundleEnabled()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $sculpin = $this
            ->getMockBuilder('sculpin\Sculpin')
            ->disableOriginalConstructor()
            ->getMock();
        $sculpin
            ->expects($this->exactly(2))
            ->method('configuration')
            ->will($this->returnValue($this->getConfigurationMock(true, false)));
        $sculpin
            ->expects($this->once())
            ->method('prepareCacheFor')
            ->with('twigGitHubGist');
        $sculpin
            ->expects($this->once())
            ->method('registerFormatterConfigurationCallback')
            ->with($this->equalTo(TwigBundle::FORMATTER_NAME));
        $twigGitHubGistBundle = new TwigGitHubGistBundle();
        $twigGitHubGistBundle->boot();
    }

    public function testConfigureTwigFormatterNotTwigFormatter()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $sculpin = $this
            ->getMockBuilder('sculpin\Sculpin')
            ->disableOriginalConstructor()
            ->getMock();
        $sculpin
            ->expects($this->never())
            ->method('configuration');
        $formatter = $this
            ->getMock('sculpin\formatter\IFormatter');
        $twigGitHubGistBundle = new TwigGitHubGistBundle();
        $twigGitHubGistBundle->configureTwigFormatter($sculpin, $formatter);
        /*
        if ($formatter instanceof TwigFormatter) {
            if ($sculpin->configuration()->get(self::CONFIG_CACHE_EANBLED)) {
                $cache = new FilesystemCache($this->cacheDirectory);
            } else {
                $cache = null;
            }
            $gistTwigExtension = new GistTwigExtension(null, $cache);
            $formatter->twig()->addExtension($gistTwigExtension);
        }
        */
    }

    public function testConfigureTwigFormatterCacheEnabled()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $sculpin = $this
            ->getMockBuilder('sculpin\Sculpin')
            ->disableOriginalConstructor()
            ->getMock();
        $sculpin
            ->expects($this->exactly(3))
            ->method('configuration')
            ->will($this->returnValue($this->getConfigurationMock()));
        $twig = $this
            ->getMock('\Twig_Environment');
        $twig
            ->expects($this->once())
            ->method('addExtension')
            ->with($this->isInstanceOf('dflydev\twig\extension\gitHub\gist\GistTwigExtension'));
        $formatter = $this
            ->getMockBuilder('sculpin\bundle\twigBundle\TwigFormatter')
            ->disableOriginalConstructor()
            ->getMock();
        $formatter
            ->expects($this->once())
            ->method('twig')
            ->will($this->returnValue($twig));
        $twigGitHubGistBundle = new TwigGitHubGistBundle();
        $twigGitHubGistBundle->configureBundle($sculpin);
        $twigGitHubGistBundle->configureTwigFormatter($sculpin, $formatter);
    }

    public function testConfigureTwigFormatterCacheDisabled()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $sculpin = $this
            ->getMockBuilder('sculpin\Sculpin')
            ->disableOriginalConstructor()
            ->getMock();
        $sculpin
            ->expects($this->exactly(3))
            ->method('configuration')
            ->will($this->returnValue($this->getConfigurationMock(true, false)));
        $twig = $this
            ->getMock('\Twig_Environment');
        $twig
            ->expects($this->once())
            ->method('addExtension')
            ->with($this->isInstanceOf('dflydev\twig\extension\gitHub\gist\GistTwigExtension'));
        $formatter = $this
            ->getMockBuilder('sculpin\bundle\twigBundle\TwigFormatter')
            ->disableOriginalConstructor()
            ->getMock();
        $formatter
            ->expects($this->once())
            ->method('twig')
            ->will($this->returnValue($twig));
        $twigGitHubGistBundle = new TwigGitHubGistBundle();
        $twigGitHubGistBundle->configureBundle($sculpin);
        $twigGitHubGistBundle->configureTwigFormatter($sculpin, $formatter);
    }

    public function testConfigureConsoleApplication()
    {
        $this->markTestSkipped('Requires update after major updates to Sculpin (needs to be aware of DIC)');
        $application = $this
            ->getMockBuilder('\sculpin\console\Application')
            ->disableOriginalConstructor()
            ->getMock();
        $inputInterface = $this->getMock('\Symfony\Component\Console\Input\InputInterface');
        $outputInterface = $this->getMock('\Symfony\Component\Console\Output\OutputInterface');
        $application
            ->expects($this->once())
            ->method('add')
            ->with($this->isInstanceOf('\dflydev\sculpin\bundle\twigGitHubGistBundle\command\cache\ClearCommand'));
        TwigGitHubGistBundle::CONFIGURE_CONSOLE_APPLICATION($application, $inputInterface, $outputInterface);
    }
}
