<?php

namespace Nicl\Silex\Tests;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Twig_Loader_String;
use Nicl\Silex\MarkdownServiceProvider;

/**
 * Tests for markdown service provider
 */
class MarkdownServiceProviderTest extends \PHPUnit_Framework_Testcase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new TwigServiceProvider());
        $this->app->register(new MarkdownServiceProvider());
    }

    /**
     * Basic test case of service provider
     */
    public function testMarkdownTwigFilter()
    {
        $twig = $this->app['twig'];
        $twig->setLoader(new Twig_Loader_String());
        $output = $twig->loadTemplate("{{ '#Hello World'|markdown }}")->render(array());

        $this->assertEquals("<h1>Hello World</h1>\n", $output);
    }
}