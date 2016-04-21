<?php

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            '\Snscripts\HtmlHelper\Services\Basic\Router',
            new \Snscripts\HtmlHelper\Services\Basic\Router
        );
    }

    public function testGetUrlReturnsSameString()
    {
        $Router = new \Snscripts\HtmlHelper\Services\Basic\Router;

        $this->assertSame(
            '/page/about-us',
            $Router->getUrl('/page/about-us')
        );
    }
}
