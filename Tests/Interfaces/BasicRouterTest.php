<?php

class BasicRouterTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            '\Snscripts\HtmlHelper\Interfaces\BasicRouter',
            new \Snscripts\HtmlHelper\Interfaces\BasicRouter
        );
    }

    public function testGetUrlReturnsSameString()
    {
        $Router = new \Snscripts\HtmlHelper\Interfaces\BasicRouter;

        $this->assertSame(
            '/page/about-us',
            $Router->getUrl('/page/about-us')
        );
    }
}