<?php

class BasicAssetsTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            '\Snscripts\HtmlHelper\Interfaces\BasicAssets',
            new \Snscripts\HtmlHelper\Interfaces\BasicAssets
        );
    }

    public function testGetImageReturnsSameString()
    {
        $Assets = new \Snscripts\HtmlHelper\Interfaces\BasicAssets;

        $this->assertSame(
            '/assets/img/logo.png',
            $Assets->getImage('/assets/img/logo.png')
        );
    }

    public function testGetStyleReturnsSameString()
    {
        $Assets = new \Snscripts\HtmlHelper\Interfaces\BasicAssets;

        $this->assertSame(
            '/assets/css/site.css',
            $Assets->getStyle('/assets/css/site.css')
        );
    }

    public function testGetScriptReturnsSameString()
    {
        $Assets = new \Snscripts\HtmlHelper\Interfaces\BasicAssets;

        $this->assertSame(
            '/assets/js/attachments.js',
            $Assets->getStyle('/assets/js/attachments.js')
        );
    }
}