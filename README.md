Twig GitHub Gist Sculpin Bundle
===============================

A [Sculpin](http://getsculpin.com) bundle to provide the ability to
embed [GitHub](http://github.com) [Gist](http://gist.github.com)
snippets into [Twig](http://twig.sensiolabs.org/) formatted pages.


Requirements
------------

 * PHP: >=5.3.2


Usage
-----

Add the following to `composer.json` for the Sculpin site:

```json
{
    "require": {
        "dflydev/twig-github-gist-sculpin-bundle": "1.*"
    }
}
```

Run `sculpin composer:update` to download the bundle and its
dependencies.

Add the following to `sculpin.yml` or whichever configuration
is most appropriate for the Sculpin site:

```yaml
bundles:
  - dflydev\sculpin\bundle\twigGitHubGistBundle\TwigGitHubGistBundle
```


License
-------

MIT, see LICENSE.


Community
---------

Want to get involved? Here are a few ways:

* Find us in the [#sculpin](irc://irc.freenode.org/sculpin) IRC
  channel on irc.freenode.org.
* Join the [Sculpin Users](http://groups.google.com/group/sculpin-users)
  mailing list.
* Mention [@getsculpin](http://twitter.com/getsculpin) on Twitter.
